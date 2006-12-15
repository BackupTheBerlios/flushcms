<?php
//------------------------------------------------------------ SYSTEM PARAMETERS
set_time_limit(0);
define("PATH_SCRIPT",      dirname(__FILE__) . "/");

//----------------------------------------------------------------- DEPENDENCIES

include_once "../include/winbinder.php";
include "class.fmod.php";

//------------------------------------------------------------------- AUDIO INIT

$fmod = new FmodAudio; // create fmod object

if(!$fmod->fmod_SoundInit()) // init system
{
  wb_message_box(NULL,"Soundsystem couldn't be initialized!\n".$fmod->lasterror, APPNAME, WBC_STOP);
}

//-------------------------------------------------------------------- CONSTANTS

define("APPNAME",           "FMOD");

// Control identifiers

define("ID_PLAY",      101);
define("ID_STOP",      102);
define("ID_OPEN",      103);
define("ID_CLOSE",   104);   
define("ID_PAUSE",   105);
define("ID_INFOTIMER",   106);
define("ID_MUTE",      107);
define("ID_VOLUMEN",   108);
define("ID_BALANCE",   109);
define("ID_BALCENTER",   110);

define("ID_EQ_LOW",   111);
define("ID_EQ_MID",   112);
define("ID_EQ_HIGH",   113);
define("ID_SURROUND",   114);


//-------------------------------------------------------------- EXECUTABLE CODE

$mainwin = wb_create_window(NULL, AppWindow, APPNAME, 530, 240);
$statusbar = wb_create_control($mainwin, StatusBar, APPNAME);

// buttons
wb_create_control($mainwin, PushButton, "Open", 10,10,100, 20, ID_OPEN);
wb_create_control($mainwin, PushButton, "Play", 110,10,100, 20, ID_PLAY);
wb_create_control($mainwin, PushButton, "Stop", 210,10,100, 20, ID_STOP);
wb_create_control($mainwin, PushButton, "Pause", 310,10,100, 20, ID_PAUSE);
wb_create_control($mainwin, PushButton, "Close", 410,10,100, 20, ID_CLOSE);
wb_create_control($mainwin, PushButton, "Mute", 10,40,50, 20, ID_MUTE);
wb_create_control($mainwin, PushButton, "Center", 10,60,50, 20, ID_BALCENTER);
wb_create_control($mainwin, PushButton, "Surround", 250,40,50, 20, ID_SURROUND);

// volumen and balance
wb_create_control($mainwin, Slider, "",       70,40,150, 20, ID_VOLUMEN);
wb_create_control($mainwin, Slider, "",       70,60,150, 20, ID_BALANCE);

wb_set_range(wb_get_control($mainwin,ID_VOLUMEN),0,255);
wb_set_value(wb_get_control($mainwin,ID_VOLUMEN),255);
wb_set_range(wb_get_control($mainwin,ID_BALANCE),0,255);
wb_set_value(wb_get_control($mainwin,ID_BALANCE),127);

// timer
wb_create_timer($mainwin, ID_INFOTIMER, 1000);

// run application
wb_set_handler($mainwin, "process_main");
wb_main_loop();

//-------------------------------------------------------------- HANDLE PROCESS

function process_main($window, $id, $ctrl)
{
   global $statusbar, $fmod;
   
   switch($id)
   {
      case ID_INFOTIMER:
         $status = "Driver: ".$fmod->fmod_GetOutputName()." / ";
         $status.= "Lengh: ".$fmod->fmod_GetLenght()." min / ";
//         $status.= "Position: ".$fmod->GetPosition()." min ";
         
         wb_set_text($statusbar, $status);         
      break;
      
      case ID_OPEN:
         $filename = wb_sys_dlg_open();
         if($filename)
         {
               if($fmod->fmod_StreamOpen($filename)) // $filename could be delivered by wb_sys_dlg_open()
               {
                  $fmod->fmod_StreamPlay();    // returns true, then play
               }
               else
               {
               wb_message_box($window,"Error opening Audiostream!\n".$fmod->lasterror, APPNAME, WBC_INFO);
            }
         }
      break;   

      case ID_CLOSE:
         $fmod->fmod_StreamStop();
      break;
   
      case ID_PLAY:
         $fmod->fmod_StreamPlay();
      break;
      
      case ID_STOP:
         $fmod->fmod_StreamStop();
      break;

      case ID_PAUSE:
         if($fmod->playstatus == 1)
         {
            switch($fmod->paused)
            {
               case 0:
                  $fmod->StreamControl('pause');
                  wb_set_text($ctrl, "Resume..");
                  break;
               case 1:         
                  $fmod->StreamControl('unpause');
                  wb_set_text($ctrl, "Pause");
                  break;
            }
         }
      break;

      case ID_MUTE:
         if($fmod->playstatus == 1)
         {
            switch($fmod->muted)
            {
               case 0:
                  $fmod->StreamControl('mute');
                  wb_set_text($ctrl, "UnMute");
                  break;
               case 1:         
                  $fmod->StreamControl('unmute');
                  wb_set_text($ctrl, "Mute");
                  break;
            }
         }
      break;

      case ID_SURROUND:
         $fmod->SetSurround();
      break;

      case ID_VOLUMEN:
         $fmod->SetVolumen(wb_get_value($ctrl));
         wb_set_text($statusbar, "Volumen: ".$fmod->GetVolumen());
      break;
      
      case ID_BALANCE:
         $fmod->SetPanning(wb_get_value($ctrl));
      break;
      
      case ID_BALCENTER:
         $fmod->SetPanning(127);
         wb_set_value(wb_get_control($window,ID_BALANCE),127);
      break;
      
      case IDCLOSE:
         $fmod->CloseSound();
         wb_release_library($fmod->fmodlib);
         wb_destroy_window($window);
      break;
   }

}
?>