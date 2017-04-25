<?php
/* PDF-Catalog generator class
 * 
 */

class CatalogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	 public $layout = 'admin_main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions                                                            
                    'roles'=>array('admin')),
            array('deny',  // deny all users
                    'users'=>array('*'))
        );
	}
	
	public function actionAdd()
	{
        if (Yii::app()->request->isAjaxRequest)
        {
            $response = array();            
            $response['result']='error';
                        
            if (!isset($_POST['product_id']) || !isset($_POST['include'])) {
                header('Content-Type: application/json; charset="UTF-8"');            
                echo CJSON::encode($response);  
                Yii::app()->end();
            }
            
            $productId = $_POST['product_id'];
            $include = ($_POST['include'] == 'true');
            
            $pdfCatalog = Yii::app()->user->getFlash('pdfCatalog', array(), false);
            
            if ($include && !in_array($pdfCatalog, $productId)) $pdfCatalog[$productId] = $productId;
            if ( !$include && isset($pdfCatalog[$productId]) )  unset($pdfCatalog[$productId]);
            
            Yii::app()->user->setFlash('pdfCatalog', $pdfCatalog);
            
            $response['catalog']=$pdfCatalog;
            $response['result']='ok';
            header('Content-Type: application/json; charset="UTF-8"');            
            echo CJSON::encode($response);
            Yii::app()->end();
        }
	}
        

    public function actionIndex()
	{	
        $products = array();
        $ids = Yii::app()->user->getFlash('pdfCatalog', array(), false);
        Yii::app()->user->setFlash('pdfCatalog', $ids);
        
        foreach($ids as $id) {
            $product = Product::model()->findByPk($id);
            if ($product !== null) $products[]=$product;
        }
                
        $html = $this->renderPartial('index', array('products'=>$products), true);
                          
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($html);
        
        $fileName = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['pdfsPath'] . count($ids)  . '_' . time() . '.pdf';
        
        $html2pdf->Output($fileName, EYiiPdf::OUTPUT_TO_FILE);
                
            
        if (file_exists($fileName)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=ProductsCatalog.pdf');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($fileName));
                ob_clean();
                flush();
                readfile($fileName);
                @unlink($fileName);
        }
                
        $this->redirect(array('/admin/product/index'));
         
	}
    
    public function actionExport()
	{	
        $products = array();
        $ids = Yii::app()->user->getFlash('pdfCatalog', array(), false);
        Yii::app()->user->setFlash('pdfCatalog', $ids);
        
        if (count($ids)==0) $products = Product::model()->findAllByAttributes(array('deleted'=>0));
        else
            foreach($ids as $id) {
                $product = Product::model()->findByPk($id);
                if ($product !== null) $products[]=$product;
            }
          
        $fileName = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['pdfsPath'] . 'export.csv';
        $csv = fopen($fileName, 'wt');
        if ($products[0]!==null) fputcsv($csv, $this->exportProductAttrNames($products[0]), ';');
        foreach($products as $product) fputcsv($csv, $this->exportProduct($product), ';');
        fclose($csv);
        
        if (file_exists($fileName)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=qpromo_export.csv');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($fileName));
                ob_clean();
                flush();
                readfile($fileName);
                @unlink($fileName);
        }
                
        $this->redirect(array('/admin/product/index'));
    }
    
    private function exportProduct($product) {
        $attr = array();
        if ($product !== null) {
            $attr = $product->attributes;
        }
        return $attr;
    }
    
    private function exportProductAttrNames($product) {
        $attr = array();
        if ($product !== null) {
            $attr = array_keys($product->attributes);
        }
        return $attr;
    }
		
}
