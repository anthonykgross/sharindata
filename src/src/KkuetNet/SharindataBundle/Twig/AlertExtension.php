<?php 

namespace KkuetNet\SharindataBundle\Twig;

class AlertExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'alert' => new \Twig_Filter_Method($this, 'alertFilter'),
        );
    }

    public function alertFilter($msg, $type = 'success')
    {    
        $debutBalise =  '<div class="container"><ul class="alert alert-'.$type.'">';
        $message     = "";
        $finBalise   =  '</ul></div>';
        $balise      = null;
        
        if(!is_array($msg)>0){
            $msg = array($msg);
        }
        foreach($msg as $mg){
            if(strlen($mg)>0){
                $message .= "<li>$mg</li>";
            }
        }
        
        if(strlen($message) > 0){
            $balise = $debutBalise.$message.$finBalise;
        }
        
        return $balise;
    }

    public function getName()
    {
        return 'alert_extension';
    }
}

?>