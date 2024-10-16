
<?php
    require("../../models/Medicine.php");
    require("../../sessionFile.php");

    if ($_SESSION['role'] !== 'Admin') {
        header('Location: userDashboard.php'); 
        exit();
    } 
    require '../../fpdf/fpdf.php';

    class PDF extends FPDF
    {
        function Tabela(){

            $this->SetFillColor(107, 144, 128);
            $this->SetTextColor(255);
            // $this->SetDrawColor(1,129,23);
            $this->SetLineWidth(.1);
            $this->SetFont('','');

            // $specific_date = '2024-10-17';

            $colunas = array('ID', 'Data', 'Medicamento', 'Entradas', 'Saidas');
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                    $medicine  = new Medicine();		
                    $medicines = $medicine->getAll(); 


                     foreach($medicines as $data): 
                        $movimentacoes = $medicine->getMovimentacoes($data->id);
                        if ($movimentacoes):
                            $this->SetTextColor(0, 0, 0);
                            $this->SetFont('','B');
                            $this->Ln();
                            $this->Cell(39, 10, $data->nome, 'C');
                            $this->SetTextColor(255);
                            $this->SetFont('','');
                            $this->Ln();
                            for($i=0;$i<5;$i++)
                            $this->Cell(39,7,$colunas[$i],1,0,'C', true);
                            $this->Ln();
                            foreach ($movimentacoes as $movimento):

                                $this->SetTextColor(0, 0, 0);
                                $this->Cell(39, 10, $data->id, 1, 0, 'C');
                                $this->Cell(39, 10, isset($movimento['data_movimento']) ? $movimento['data_movimento'] : '-', 1, 0, 'C');
                                $this->Cell(39, 10, $data->nome, 1, 0, 'C');
                                $this->Cell(39, 10, isset($movimento['total_entradas']) ? $movimento['total_entradas'] : '0', 1, 0, 'C');
                                $this->Cell(39, 10, isset($movimento['total_saidas']) ? $movimento['total_saidas'] : '0', 1, 0, 'C');
                                $this->Ln();
                     
                            endforeach;  
                            $this->SetTextColor(255);
                        endif;  
                    endforeach; 
        }
    }


   $pdf = new PDF(); 
   $pdf-> SetFont('Arial','B', 14);
    $pdf -> AddPage();
    $pdf -> Tabela();
    $pdf->OutPut();

?>
