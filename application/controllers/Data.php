<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('upload_m');
        $this->load->helper('url');
    }
    //index
    public function index()
    {
        check_not_login();
        $data['row'] = $this->upload_m->view_list()->result();
        $this->template->load('template', 'v_database', $data);
    }
    public function del_process()
    {
        $idData = $this->uri->segment(3);
        $this->upload_m->del($idData);

        
        if ($this->db->affected_rows() > 0) {
            # code...
            echo "<script>
			alert('success');
			</script>";
        }
        echo
            "<script>
			window.location='" . site_url('data') . "';
		</script>";
    }
    public function edit_database($id)
    {
        check_not_login();
        $this->load->model('upload_m');
        $data['row'] = $this->upload_m->get($id)->row_array();
        // var_dump($data);
        // die;
        $this->template->load('template', 'v_edit_database', $data);
    }
    public function edit_database_process()
    {
        $id = $this->input->post('ID');
        $Campaign_ID = $this->input->post('Campaign_ID');
        $Date = $this->input->post('Date');
        $Company_Name = $this->input->post('Company_Name');
        $First_Name = $this->input->post('First_Name');
        $Last_Name = $this->input->post('Last_Name');
        $Job_Tittle = $this->input->post('Job_Tittle');
        $Email_Addr = $this->input->post('Email_Addr');
        $Primary_Phone = $this->input->post('Primary_Phone');
        $Address = $this->input->post('Address');
        $City = $this->input->post('City');
        $State = $this->input->post('State');
        $Zip = $this->input->post('Zip');
        $Country = $this->input->post('Country');
        $Employee_Size = $this->input->post('Employee_Size');
        $Industry_Type = $this->input->post('Industry_Type');
        $Linked_In_Link = $this->input->post('Linked_In_Link');

        // Random Alphanumeric-Code for validate to duplicate data
        $Fname = $First_Name;
        $Lname = $Last_Name;
        $Cname = $Company_Name;
        $S_Fname = substr($Fname, 0, 3);
        $S_Lname = substr($Lname, 0, 3);
        $S_Cname = substr($Cname, 0, 3);
        $concatenate = $S_Fname . $S_Lname . $S_Cname;
        $Valid_Check = $this->input->post($concatenate);

        //input
        $data = array(
            'Campaign_ID' => $Campaign_ID,
            'Date' => $Date,
            'Company_Name' => $Company_Name,
            'First_Name' => $First_Name,
            'Last_Name' => $Last_Name,
            'Job_Tittle' => $Job_Tittle,
            'Email_Addr' => $Email_Addr,
            'Primary_Phone' => $Primary_Phone,
            'Address' => $Address,
            'City' => $City,
            'State' => $State,
            'Zip' => $Zip,
            'Country' => $Country,
            'Employee_Size' => $Employee_Size,
            'Industry_Type' => $Industry_Type,
            'Linked_In_Link' => $Linked_In_Link,
            'Valid_Check' => $concatenate,
        );
        $where = array('ID' => $id);
        $this->load->model('upload_m');
        $this->upload_m->update($where, $data, 'data_uploaded');
        if ($this->db->affected_rows() > 0) {
            # code...
            echo "<script>
			alert('update success');
			</script>";
        }
        echo
            "<script>
		window.location='" . site_url('data') . "';
		</script>";
    }
    public function export_excel_by_date()
    {

        $tgl1 = $this->input->post('tgl_a');
        $tgl2 = $this->input->post('tgl_b');
        //cek apa ada data --> kalo ada jalankan metode
        //kalo tidak -->tampil notif
        //dasar query
        $this->load->model('upload_m');
        $row = $this->upload_m->get_by_date($tgl1, $tgl2)->result_array();
        if ($row == null) {
            echo "<script>
                	alert('NO DATA AVAILABLE');
                	window.location='" . site_url('data') . "';
                    </script>";
        } else {
            error_reporting(E_ALL);
            include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
            include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';
            include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';

            // Panggil class PHPExcel nya
            $excel = new PHPExcel();
            // Settingan awal fil excel
            $excel->getProperties()->setCreator('Al-Hakim')
                ->setLastModifiedBy('Al-Hakim')
                ->setTitle("Database")
                ->setSubject("Data Sub")
                ->setDescription("Report All Data")
                ->setKeywords("Database");
            // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
            $style_col = array(
                'font' => array('bold' => true),
                // Set font nya jadi bold
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
                ),
                'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border left dengan garis tipis
                ),
            );
            // end
            // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
            $style_row = array(
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ),
                'borders' => array(
                    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                ),
            );
            //end
            $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATABASE");
            $excel->getActiveSheet()->mergeCells('A1:Q1');
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
            $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //header set
            $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
            $excel->setActiveSheetIndex(0)->setCellValue('B3', "CAMPAIGN ID");
            $excel->setActiveSheetIndex(0)->setCellValue('C3', "DATE");
            $excel->setActiveSheetIndex(0)->setCellValue('D3', "COMPANY NAME");
            $excel->setActiveSheetIndex(0)->setCellValue('E3', "FIRST NAME");
            $excel->setActiveSheetIndex(0)->setCellValue('F3', "LAST NAME");
            $excel->setActiveSheetIndex(0)->setCellValue('G3', "JOB TITTLE");
            $excel->setActiveSheetIndex(0)->setCellValue('H3', "EMAIL ADDRES");
            $excel->setActiveSheetIndex(0)->setCellValue('I3', "PRIMARY PHONE");
            $excel->setActiveSheetIndex(0)->setCellValue('J3', "ADDRESS");
            $excel->setActiveSheetIndex(0)->setCellValue('K3', "CITY");
            $excel->setActiveSheetIndex(0)->setCellValue('L3', "STATE");
            $excel->setActiveSheetIndex(0)->setCellValue('M3', "ZIP CODE");
            $excel->setActiveSheetIndex(0)->setCellValue('N3', "COUNTRY");
            $excel->setActiveSheetIndex(0)->setCellValue('O3', "EMPLOYYE SIZE");
            $excel->setActiveSheetIndex(0)->setCellValue('P3', "INDUSTRI TYPE");
            $excel->setActiveSheetIndex(0)->setCellValue('Q3', "SIC CODE");
            $excel->setActiveSheetIndex(0)->setCellValue('R3', "NAICS CODE");
            $excel->setActiveSheetIndex(0)->setCellValue('S3', "REVENUE SIZE");
            $excel->setActiveSheetIndex(0)->setCellValue('T3', "LINKEDIN ACCOUNT");
            $excel->setActiveSheetIndex(0)->setCellValue('U3', "VALIDATION TOKEN");
            //END
            //APPLY HEADER STYLE
            $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
            //END
            //LOAD MODEL FUNCTION TO GET ALL DATA
            $data = $this->upload_m->get_by_date($tgl1, $tgl2)->result();
            // var_dump($data);
            // die;
            $no = 1;
            $numrow = 4;
            foreach ($data as $row) {
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $row->Campaign_ID);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $row->Date);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $row->Company_Name);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $row->First_Name);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $row->Last_Name);
                $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $row->Job_Tittle);
                $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $row->Email_Addr);
                $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $row->Primary_Phone);
                $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $row->Address);
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $row->City);
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $row->State);
                $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $row->Zip);
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $row->Country);
                $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, $row->Employee_Size);
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $row->Industry_Type);
                $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $row->Sic_Code);
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $row->Naics_Code);
                $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $row->Revenue_Size);
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, $row->Linked_In_Link);
                $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $row->Valid_Check);

                //
                //APPLY STYLE
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
                $no++;
                $numrow++;
            }
            // Set width kolom
            //END
            //SET HEIGHT
            $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

            //SET ORIENTATION
            $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            //TITTLE FILE
            $excel->getActiveSheet(0)->setTitle("REPORT");
            $excel->setActiveSheetIndex(0);

            //PROSESS
            $filename = "report_by_date" . '.xlsx';
            ob_end_clean();
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $write->save('php://output');
            // readfile($filename);
            // exit;

        }
    }
    public function export_excel()
    {
        error_reporting(E_ALL);
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';
        include APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOfactory.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Al-Hakim')
            ->setLastModifiedBy('Al-Hakim')
            ->setTitle("Database")
            ->setSubject("Data Sub")
            ->setDescription("Report All Data")
            ->setKeywords("Database");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true),
            // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border left dengan garis tipis
            ),
        );
        // end
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            ),
        );
        //end
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATABASE");
        $excel->getActiveSheet()->mergeCells('A1:Q1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //header set
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "CAMPAIGN ID");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "DATE");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "COMPANY NAME");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "FIRST NAME");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "LAST NAME");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "JOB TITTLE");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "EMAIL ADDRES");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "PRIMARY PHONE");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "ADDRESS");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "CITY");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "STATE");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "ZIP CODE");
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "COUNTRY");
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "EMPLOYYE SIZE");
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "INDUSTRI TYPE");
        $excel->setActiveSheetIndex(0)->setCellValue('Q3', "SIC CODE");
        $excel->setActiveSheetIndex(0)->setCellValue('R3', "NAICS CODE");
        $excel->setActiveSheetIndex(0)->setCellValue('S3', "REVENUE SIZE");
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "LINKEDIN ACCOUNT");
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "VALIDATION TOKEN");
        //END
        //APPLY HEADER STYLE
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
        //END
        //LOAD MODEL FUNCTION TO GET ALL DATA
        $data = $this->upload_m->view_list()->result();
        // var_dump($data);
        // die;
        $no = 1;
        $numrow = 4;
        foreach ($data as $row) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $row->Campaign_ID);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $row->Date);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $row->Company_Name);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $row->First_Name);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $row->Last_Name);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $row->Job_Tittle);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $row->Email_Addr);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $row->Primary_Phone);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $row->Address);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $row->City);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $row->State);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $row->Zip);
            $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $row->Country);
            $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, $row->Employee_Size);
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $row->Industry_Type);
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $row->Sic_Code);
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $row->Naics_Code);
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $row->Revenue_Size);
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, $row->Linked_In_Link);
            $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $row->Valid_Check);

            //
            //APPLY STYLE
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }
        // Set width kolom
        //END
        //SET HEIGHT
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        //SET ORIENTATION
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        //TITTLE FILE
        $excel->getActiveSheet(0)->setTitle("REPORT");
        $excel->setActiveSheetIndex(0);

        //PROSESS
        $filename = "report" . '.xlsx';
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        // readfile($filename);
        // exit;
    }
}
