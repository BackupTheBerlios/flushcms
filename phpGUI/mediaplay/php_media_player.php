<?php
//----------------------------------------------------------------- DEPENDENCIES
include_once "include/winbinder.php";
include "class.fmod.php";

//------------------------------------------------------------------- AUDIO INIT

$fmod = new FmodAudio; // create fmod object

if(!$fmod->fmod_SoundInit()) // init system
{
  wb_message_box(NULL,"Soundsystem couldn't be initialized!\n".$fmod->fmodLastErrorMsg, APPNAME, WBC_STOP);
}

//-------------------------------------------------------------------- CONSTANTS

define("APPNAME",           "����ý�岥����");

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
define("ID_PLAY_POS",   115);


//-------------------------------------------------------------- EXECUTABLE CODE

$mainwin = wb_create_window(NULL, AppWindow, APPNAME, 530, 240);
$statusbar = wb_create_control($mainwin, StatusBar, APPNAME);

// buttons
wb_create_control($mainwin, PushButton, "��", 10,10,100, 20, ID_OPEN);
wb_create_control($mainwin, PushButton, "����", 110,10,100, 20, ID_PLAY);
wb_create_control($mainwin, PushButton, "ֹͣ", 210,10,100, 20, ID_STOP);
wb_create_control($mainwin, PushButton, "��ͣ", 310,10,100, 20, ID_PAUSE);
wb_create_control($mainwin, PushButton, "�ر�", 410,10,100, 20, ID_CLOSE);
wb_create_control($mainwin, PushButton, "����", 10,40,50, 20, ID_MUTE);
wb_create_control($mainwin, PushButton, "�м�", 10,60,50, 20, ID_BALCENTER);
wb_create_control($mainwin, PushButton, "ѭ��", 250,40,50, 20, ID_SURROUND);

// volumen and balance
wb_create_control($mainwin, Slider, "",       70,40,150, 20, ID_VOLUMEN);
wb_create_control($mainwin, Slider, "",       70,60,150, 20, ID_BALANCE);
wb_create_control($mainwin, Slider, "���Ž���",       70,100,250, 20, ID_PLAY_POS);

wb_set_range(wb_get_control($mainwin,ID_VOLUMEN),0,255);
wb_set_value(wb_get_control($mainwin,ID_VOLUMEN),255);
wb_set_range(wb_get_control($mainwin,ID_BALANCE),0,255);
wb_set_value(wb_get_control($mainwin,ID_BALANCE),127);

wb_set_range(wb_get_control($mainwin,ID_PLAY_POS),0,100);
wb_set_value(wb_get_control($mainwin,ID_PLAY_POS),0);

// timer
wb_create_timer($mainwin, ID_INFOTIMER, 1000);

// run application
wb_set_image($mainwin,"resource/musicm.ico");
wb_set_handler($mainwin, "process_main");
wb_main_loop();

//-------------------------------------------------------------- HANDLE PROCESS

function process_main($window, $id, $ctrl)
{
   global $statusbar, $fmod,$mainwin;
   
   switch($id)
   {
      case ID_INFOTIMER:
         $status = "����: ".$fmod->fmod_GetOutputName()." ";
         $status.= "��������: ".$fmod->fmod_GetLenght(true)." ���� ";
         $status.= "�Ѳ���: ".($fmod->fmod_Msec2Time($fmod->fmod_GetTime(true)))." sec ";
         if ($song_name = $fmod->fmodStreamUrl)
         	$status.= "����: {$song_name} ";
         
         wb_set_text($statusbar, $status);    
         
//		play position
		if($fmod->fmod_GetLenght(false))
			wb_set_value(wb_get_control($mainwin,ID_PLAY_POS),round($fmod->fmod_GetTime(false)/$fmod->fmod_GetLenght(false),2)*100 );
		              
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
         if($fmod->fmodStreamState == 1)
         {
            switch($fmod->fmodIsPaused)
            {
               case 0:
                  $fmod->fmod_SoundPause(true);
                  wb_set_text($ctrl, "����..");
                  break;
               case 1:         
                   $fmod->fmod_SoundPause(false);
                  wb_set_text($ctrl, "��ͣ");
                  break;
            }
         }
      break;

      case ID_MUTE:
         if($fmod->fmodStreamState == 1)
         {
            switch($fmod->fmodIsMuted)
            {
               case 0:
                  $fmod->fmod_SoundMute(true);
                  wb_set_text($ctrl, "����");
                  break;
               case 1:         
                  $fmod->fmod_SoundMute(false);
                  wb_set_text($ctrl, "����");
                  break;
            }
         }
      break;

      case ID_SURROUND:
      
       switch($fmod->fmodSurroundEnabled)
        {
           case 0:
         	  $fmod->fmod_SetSurround(true);
              wb_set_text($ctrl, "ѭ��");
              break;
           case 1:         
          	  $fmod->fmod_SetSurround(false);
              wb_set_text($ctrl, "��ѭ��");
              break;
        }
      break;

      case ID_VOLUMEN:
         $fmod->fmod_SetVolumen(wb_get_value($ctrl));
         wb_set_text($statusbar, "����: ".$fmod->fmod_GetVolumen());
      break;
      
      case ID_BALANCE:
         $fmod->fmod_SetPanning(wb_get_value($ctrl));
      break;
      
      case ID_BALCENTER:
         $fmod->fmod_SetPanning(127);
         wb_set_value(wb_get_control($window,ID_BALANCE),127);
      break;
      
      case IDCLOSE:
         $fmod->fmod_SoundClose();
         wb_release_library($fmod->fmodlib);
         wb_destroy_window($window);
      break;
   }

}
?>