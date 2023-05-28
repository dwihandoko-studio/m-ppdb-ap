<?php
if (!function_exists('_create_name_foto')) {
    function _create_name_foto($string, $nisn = 'a')
    {
        $file_parts = pathinfo($string);
        $exts = $file_parts['extension'];
        $date = 'PPDB-' . $nisn . '-' . date('Y-m-d') . '-at-' . date('H-i-s') . '-' . rand(1000000, 9999999);

        //var_dump($exts);die;

        $replace = '-';
        if ($exts == 'jpg') {
            $string = str_replace(".jpg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'png') {
            $string = str_replace(".png", "", $string);
            $ext = '.png';
        } elseif ($exts == 'jpeg') {
            $string = str_replace(".jpeg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'gif') {
            $string = str_replace(".gif", "", $string);
            $ext = '.gif';
        } elseif ($exts == 'pdf') {
            $string = str_replace(".pdf", "", $string);
            $ext = '.pdf';
        } else {
            $ext = '.txt';
        }
        $string = strtolower($string);
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);
        //limit the slug size     
        $string = substr($string, 0, 100);
        //text is generated     
        return ($ext) ? $date . $ext : $date . $ext;
    }
}

if (!function_exists('_create_name_pdf')) {
    function _create_name_pdf($string, $key = "")
    {
        $file_parts = pathinfo($string);
        $exts = $file_parts['extension'];
        $date = (($key == "") ? 'LAMPIRAN-PDF' : $key) . '-' . date('Y-m-d') . '-at-' . date('H-i-s') . '-' . rand(1000000, 9999999);

        //var_dump($exts);die;

        $replace = '-';
        if ($exts == 'jpg') {
            $string = str_replace(".jpg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'png') {
            $string = str_replace(".png", "", $string);
            $ext = '.png';
        } elseif ($exts == 'jpeg') {
            $string = str_replace(".jpeg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'gif') {
            $string = str_replace(".gif", "", $string);
            $ext = '.gif';
        } elseif ($exts == 'pdf') {
            $string = str_replace(".pdf", "", $string);
            $ext = '.pdf';
        } else {
            $ext = '.pdf';
        }
        $string = strtolower($string);
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);
        //limit the slug size     
        $string = substr($string, 0, 100);
        //text is generated     
        return ($ext) ? $date . $ext : $date . $ext;
    }
}

if (!function_exists('_create_name_import')) {
    function _create_name_import($string)
    {
        $file_parts = pathinfo($string);
        $exts = $file_parts['extension'];
        $date = 'PPDB-' . date('Y-m-d') . '-at-' . date('H-i-s');

        //var_dump($exts);die;

        $replace = '-';
        if ($exts == 'jpg') {
            $string = str_replace(".jpg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'png') {
            $string = str_replace(".png", "", $string);
            $ext = '.png';
        } elseif ($exts == 'jpeg') {
            $string = str_replace(".jpeg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'gif') {
            $string = str_replace(".gif", "", $string);
            $ext = '.gif';
        } else {
            $ext = '.' . $exts;
        }
        $string = strtolower($string);
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);
        //limit the slug size     
        $string = substr($string, 0, 100);
        //text is generated     
        return ($ext) ? $date . $ext : $date . $ext;
    }
}

if (!function_exists('_create_name_foto_album')) {
    function _create_name_foto_album($string)
    {
        $file_parts = pathinfo($string);
        $exts = $file_parts['extension'];
        $date = 'PPDB-' . date('Y-m-d') . '-at-' . date('H-i-s');


        $replace = '-';
        if ($exts == 'jpg') {
            $string = str_replace(".jpg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'png') {
            $string = str_replace(".png", "", $string);
            $ext = '.png';
        } elseif ($exts == 'jpeg') {
            $string = str_replace(".jpeg", "", $string);
            $ext = '.jpg';
        } elseif ($exts == 'gif') {
            $string = str_replace(".gif", "", $string);
            $ext = '.gif';
        } else {
            $ext = '.jpg';
        }
        $string = strtolower($string);
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);
        //limit the slug size     
        $string = substr($string, 0, 100);
        //text is generated     
        return ($ext) ? $date . $ext : $date . $ext;
    }
}

if (!function_exists('_create_url')) {
    function _create_url($string, $category = null, $ext = '.html')
    {
        $date = date('Y-m-d');
        $replace = '-';
        $string = strtolower($string);
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);
        //limit the slug size     
        $string = substr($string, 0, 200);
        //text is generated     
        if ($category != null) {
            $url = $date  . "-" . $category . "-" . $string;
        } else {
            $url = $date  . "-umum-" . $string;
        }
        return ($ext) ? $url . $ext : $url;
    }
}

if (!function_exists('_create_url_toko')) {
    function _create_url_toko($string)
    {
        // $date = date('Y-m-d') . "-";
        $replace = '-';
        $string = strtolower($string);
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);
        //limit the slug size     
        $string = substr($string, 0, 200);
        //text is generated     
        return $string;
    }
}

if (!function_exists('_create_url_album')) {
    function _create_url_album($opd, $string, $category = null, $ext = '.html')
    {
        // $date = date('Y-m-d') . "-";
        $replace = '-';
        $string = strtolower($string);
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);
        //limit the slug size     
        $string = substr($string, 0, 200);
        //text is generated     
        if ($category != null) {
            $url = $opd . "-" . $category . "-" . $string;
        } else {
            $url = $opd . "-umum-" . $string;
        }
        return ($ext) ? $url . $ext : $url;
    }
}

if (!function_exists('searchFromArray')) {
    function searchFromArray($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value)
                $results[] = $array;

            foreach ($array as $subarray)
                $results = array_merge($results, searchFromArray($subarray, $key, $value));
        }

        return $results;
    }
}
