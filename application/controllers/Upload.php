<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Upload extends CI_Controller
{

    function get_ajax_admin()
    {
        $this->load->model('Upload_m');
        $list = $this->Upload_m->get_datatables_admin();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

            $row[] = $no . ".";
            $row[] = $item->Company_Name;
            $row[] = $item->First_Name;
            $row[] = $item->Last_Name;
            $row[] = $item->Valid_Check;
            $row[] = $item->Uploaded_By;
            $row[] = date('d F Y', strtotime($item->Created_At));
            $row[] = '<a href="' . site_url('data/edit_database/' . $item->ID) . '" class="btn btn-warning btn-flat btn-small"><i class="fas fa-pencil-alt"></i></a>
            <a href="' . site_url('data/del_process/'). $item->ID . '"class="btn btn-danger btn-flat btn-small"><i class="fas fa-trash-alt"></i></a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->Upload_m->count_all(),
            "recordsFiltered" => $this->Upload_m->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }


    // User 
    function get_ajax()
    {
        $this->load->model('Upload_m');
        $list = $this->Upload_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

            $row[] = $no . ".";
            $row[] = $item->Company_Name;
            $row[] = $item->First_Name;
            $row[] = $item->Last_Name;
            $row[] = $item->Valid_Check;
            $row[] = $item->Uploaded_By;
            $row[] = date('d F Y', strtotime($item->Created_At));
            $row[] = '<a href="' . site_url('data/edit_database/' . $item->ID) . '" class="btn btn-warning btn-flat btn-small"><i class="fas fa-pencil-alt"></i></a>
            <a href="' . site_url('data/del_process/'). $item->ID . '"class="btn btn-danger btn-flat btn-small"><i class="fas fa-trash-alt"></i></a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->Upload_m->count_all(),
            "recordsFiltered" => $this->Upload_m->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
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
    }

    /**
     * void
     */
    public function import()
    {
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOfactory.php';
        $this->load->library('upload');
        $file = $_FILES['userfile']['name'];
        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '5120';
        $this->upload->initialize($config);
        // buat fungsi untuk kode validasi
        if (!$this->upload->do_upload()) {
            //upload gagal
            $this->session->set_flashdata('error', 'Field cannot is Empty Select the File');
            echo "<script>
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
                $getdate = date('Y-m-d');
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

            function filter($value)
            {
                return !is_null($value['Campaign_ID']) &&
                    !is_null($value['Revenue_Size']) &&
                    !is_null($value['Date']) &&
                    !is_null($value['First_Name']) &&
                    !is_null($value['Last_Name']) &&
                    !is_null($value['Job_Tittle']) &&
                    !is_null($value['Email_Addr']) &&
                    !is_null($value['Primary_Phone']) &&
                    !is_null($value['Address']) &&
                    !is_null($value['City']) &&
                    !is_null($value['State']) &&
                    !is_null($value['Zip']) &&
                    !is_null($value['Country']) &&
                    !is_null($value['Employee_Size']) &&
                    !is_null($value['Sic_Code']) &&
                    !is_null($value['Naics_Code']) &&
                    !is_null($value['Revenue_Size']) &&
                    !is_null($value['Linked_In_Link']);
            }

            $new = array_filter($data, 'filter');
            $count = count($new);
            $this->load->model('Upload_m');
            $process = $this->Upload_m->insert_multiple($new);
            unlink(realpath('excel/' . $data_upload['file_name']));

            if (!$process) {
                $this->delduplicate();
                $this->session->set_flashdata('success', $count);
                redirect('view/userview');
            } else {
                $this->session->set_flashdata('error', 'Field cannot is Empty Select the File');
                redirect('Dashboard/index');
            }
        }
    }
}
//array(0) { } -->ini hasilnya
