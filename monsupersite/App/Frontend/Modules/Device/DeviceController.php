<?php
namespace App\Frontend\Modules\Device;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\FormHandler;
use \mobiledetect\mobiledetectlib\Mobile_Detect;


class DeviceController extends BackController
{

  public function executeGetDeviceType(HTTPRequest $request)
  {

  require_once ''/vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';
  $detect = new Mobile_Detect;

  $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
  $scriptVersion = $detect->getScriptVersion();

  $this->app->user()->setFlash(var_dump($deviceType)); die;
  $this->app->user()->setFlash('La news a bien été supprimée !');


  }


 
 



}

?>