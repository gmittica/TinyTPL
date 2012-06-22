<?php

/**
 * TinyTPL 
 * Copyright (c) 2012 Gabriele Mittica
 * @author Gabriele Mittica 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */   
 
class TinyTpl {
    /**
     * Data stored by TPL
     * @var array
     */
    private $_data = array();   
    
    /**
     * Data used by the view (overwrite the $_data)
     * @var array
     */
    private $_dataView = array();
        
    /** 
     * Renders a view
     * @param string $fileName the view filename
     * @param array|bool if needed, you can overwrite the data stored with a new data array used by the renderer
     * @return string the view rendered 
     */                  
    public function render( $fileName, $data = false ) 
    {
        if($data) {
            $this->_dataView = $data;
        }
        if(defined("TINY_TPL_PATH")) {
            $fileName = TINY_TPL_PATH.$fileName;
        }
        $rendered = "";
        if(file_exists($fileName)) {
            ob_start();
            require($fileName);   
            $rendered = ob_get_contents(); 
            ob_end_clean();         
        }
        $this->_dataView = array();
        return $rendered;             
    }
    
    /** 
     * Renders a view for each element of array
     * @param string $fileName the view filename
     * @param array the array of elements that will be used by the view
     * @return string the views rendered
     */      
    
    public function renderAr ($fileName, $dataAr) { 
        $rendered = "";
        if(count($dataAr && is_array($dataAr))) {
            foreach($dataAr AS $data) {
                $rendered.= $this->render($fileName, $data);
            }
        }
        return $rendered;
    
    }
    
    /**
     * magic method set
     */          
    public function __set($key, $value) 
    {
        $this->_data[$key] = $value;
    }
     
    /**
     * magic method get
     */    
    public function __get($key) 
    {
        if(isset($this->_dataView[$key])) {  
            return $this->_dataView[$key];
        }
        else if(isset($this->_data[$key])) {
            return $this->_data[$key];
        }
        else {
            return false;
        }
    }
}