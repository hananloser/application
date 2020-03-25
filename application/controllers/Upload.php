<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Upload extends CI_Controller
{
    //index
    public function index()
    {
        check_not_login();
        $this->template->load('template', 'v_upload');
    }
    //query for cek duplicate data
    public function del_empty_row()
    {
        $this->db->query('DELETE FROM data_uploaded
        WHERE Country = "" OR
        Employee_Size = "" OR
        Industry_Type = "" OR
        Revenue_Size =""'); //
    }
    public function delduplicate()
    {
        $this->db->query('DELETE t1 FROM data_uploaded t1
        INNER JOIN data_uploaded  t2
        WHERE
        t1.ID < t2.ID AND
        t1.Email_Addr = t2.Email_Addr AND
        t1.Valid_Check = t2.Valid_Check');
        sleep(2);
    }
    // file upload functionality
    public function import()
    {
        $this->template->load('template', 'v_upload');
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOfactory.php';
        $this->load->library('upload');
        $file = $_FILES['userfile']['name'];
        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '1024';
        $this->upload->initialize($config);
        // buat fungsi untuk kode validasi
        if (!$this->upload->do_upload()) {

            //upload gagal
            //cek inputan dan konigurasi
            echo
            "<script>
				alert('Silahkan Input File terlebih dahulu');
				window.location='" . site_url('upload') . "';
				</script>";
        } else {
            $data_upload = $this->upload->data();

            $excel_reader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excel_reader->load('excel/' . $data_upload['file_name']);
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            //array
            $data = array();
            $numrow = 1;
            foreach ($sheet as $row) {
                // ID_code-generator
                // Random Alphanumeric-Code for validate to duplicate data
                $Fname = $row['D'];
                $Lname = $row['E'];
                $Cname = $row['C'];
                $S_Fname = substr($Fname, 0, 3); // Ambil 3 huruf dari index  0 , 3
                $S_Lname = substr($Lname, 0, 3);
                $S_Cname = substr($Cname, 0, 3);
                // Gabung String
                $concatenate = $S_Fname . $S_Lname . $S_Cname;
                $getdate = date('d-m-Y');
                $CreatedBy = $this->session->userdata('username');
                // If Ini Tedk Perlu
                if ($numrow > 1) {
                    array_push($data, array(
                        'Campaign_ID' => $row['A'],
                        'Date' => $row['B'],
                        'Company_Name' => $row['C'],
                        'First_Name' => $row['D'],
                        'Last_Name' => $row['E'],
                        'Job_Tittle' => $row['F'],
                        'Email_Addr' => $row['G'],
                        'Primary_Phone' => $row['H'],
                        'Address' => $row['I'],
                        'City' => $row['J'],
                        'State' => $row['K'],
                        'Zip' => $row['L'],
                        'Country' => $row['M'],
                        'Employee_Size' => $row['N'],
                        'Industry_Type' => $row['O'],
                        'Sic_Code' => $row['P'],
                        'Naics_Code' => $row['Q'],
                        'Revenue_Size' => $row['R'],
                        'Linked_In_Link' => $row['S'],
                        'Valid_Check' => $concatenate,
                        'Created_At' => $getdate,
                        'Uploaded_By' => $CreatedBy,
                    ));
                }
                $numrow++;
            }

            foreach ($data as $key => $value) {
                if ($value['Campaign_ID'] == null && $value['Date'] == null) {
					
					// Sisipkan Di sini flash data nya setalah itu di redirect ke halaman dashboard

                }
			}
			
            $this->load->model('Upload_m');
            $process = $this->Upload_m->insert_multiple($data);
            unlink(realpath('excel/' . $data_upload['file_name']));
            $this->delduplicate();
            $this->del_empty_row();
            if (!$process) {
                echo
                "<script>
                	alert('Proses Import Berhasil Berhasil');
                	window.location='" . site_url('view/userview') . "';
                    </script>";
            } else {
                echo
                "<script>
                	alert('Error');
                	window.location='" . site_url('upload') . "';
                    </script>";
            }
        }
    }
}
//array(0) { } -->ini hasilnya
