<?php

namespace App\Helpers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Aspose\Words\WordsApi;
use Aspose\Words\Model\Requests\ConvertDocumentRequest;

class File {

    public static function exWord($docxTemplate, $data, $data2, $clone = null) {

        $fileWord = new TemplateProcessor('document_template/' . $docxTemplate . '.docx');

        if ($clone) {
            
            $fileWord->cloneRowAndSetValues($clone, $data);
    
            $fileWord->setValues(array(
                'title' => $data2['title'],
                'd' => date('d'),
                'm' => date('m'),
                'y' => date('Y'),
                'date_time' => $data2['date_time'],
                'address' => $data2['address'],
                'list_count' => count($data),
            ));


        } else {

            $fileWord->setValues($data);

        }
    
    
        $path = 'cache/' . $docxTemplate . '.docx';
    
        $fileWord->saveAs($path);

        return $path;
    }

    public static function exPdf($docxTemplate, $data, $data2, $clone = null) {
        
        $path = self::exWord($docxTemplate, $data, $data2, $clone);

        $appSid = "24651ae7-c699-47a1-b5c8-f9b5896e252f";
        $appKey = "16b68908b9d34dd333aaa8e8f3e6f2a5";
        $wordsApi = new WordsApi($appSid, $appKey);

        $request = new ConvertDocumentRequest($path, "pdf");
        $result = $wordsApi->convertDocument($request);

        // Save an output file as "sample.docx"
        rename($result->getPathname(), 'cache/' . $docxTemplate . '.pdf');

        return 'cache/' . $docxTemplate . '.pdf';
    }

}