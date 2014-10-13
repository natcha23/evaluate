<?php
class Systemapi_ErrorController extends Workflow_Controller_Action
{
    public function errorAction()
    {
        $errors = $this->_getParam("error_handler");

        if($errors) {
        	$exception = $errors->exception;
            $log = new Zend_Log(new Zend_Log_Writer_Stream(APP_DIR."/log/".date("Ymd")."_applicationException.log"));

            $msg = $exception->getMessage();
            $backTrace = $exception->getTraceAsString();

            $log->debug($msg."\r\n".$backTrace);

            switch ($errors->type) {
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                    // 404 error -- controller or action not found
                    // $this->getResponse()->setRawHeader("HTTP/1.1 404 Not Found");

                    $content =<<<EOH
<h1 style="color:#990000;">Error! : 404 Not Found</h1>
<p>The page you requested was not found.</p>

<h3 style="color:#990000;">Message :</h3>
<p>$msg</p>

<h3 style="color:#990000;">BackTrace :</h3>
<p>$backTrace</p>
EOH;
                    break;
                default:

                    // application error
                    // $backTrace = explode("#",$backTrace);
                    $backTrace = str_replace("#","<b>Line #</b>",nl2br($backTrace));
                    $content =<<<EOH
<h1 style="color:#990000;">Error!</h1>
<p>An unexpected error occurred with your request. Please try again later.</p>

<h3 style="color:#990000;">Message :</h3>
<p>$msg</p>

<h3 style="color:#990000;">BackTrace :</h3>
<p>$backTrace</p>
EOH;
                    break;
            }
        }
        // Clear previous content
        $this->getResponse()->clearBody();

/*      $template_dir  = APP_DIR."/".$this->view->_gtemplate_path."/tpl";
        $this->view->SetTemplate($template_dir);
*/

        $vars = array();
        $vars["content"] = $content;
        $view = Zend_Registry :: get("view");
        
        $view->vars = $vars;
        
        $layout = $this->_helper->layout;
        $layout->setLayout('error');
        
//         $view = $this->view = $this->_helper->viewRenderer->view;
//         $view->message = $result->message;
        
//         $this->render();
        
//         $view->assign("",$vars);
//         $view->output("error.tpl");
    }
    
    public function inaccessibleAction()
    {
    	$view = Zend_Registry :: get("view");
    	$view->output("inaccessible.tpl");
    }
}