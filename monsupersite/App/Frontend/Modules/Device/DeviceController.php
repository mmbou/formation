<?php
namespace App\Frontend\Modules\Device;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\FormHandler;
use \Mobile_Detect;


class DeviceController extends BackController
{

  public function executeGetDeviceType(HTTPRequest $request)
  {

    
  $detect = new Mobile_Detect;

  $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

  $this->page->addVar('type', $deviceType);


  }


 
 



}

?>