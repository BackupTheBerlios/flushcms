<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * FMOD for WinBinder
 * Copyright (C) 2005.2006  Kjell Bublitz <m3nt0r.de@gmail.com>
 *
 * @author Kjell Bublitz <m3nt0r.de@gmail.com>
 * @copyright 2005-2006 K. Bublitz, m3nt0r.de
 * @license http://creativecommons.org/licenses/GPL/2.0/  CC-GPL 2.0
 * @link http://wiki.m3nt0r.de/index.php/WinBinder_Stuff/FMOD_Audio_Class/Sourcecode_03
 */

// Outputtypes
define( "OUTPUT_NONE", 0); // Null Output
define( "OUTPUT_WMM", 1); // Windows Mulitmedia
define( "OUTPUT_DIRECTSOUND", 2); // Direct Sound
define( "OUTPUT_AUREAL3D", 3); // Aureal 3D
define( "OUTPUT_ASIO", 7);  // ASIO Sound

// Config
define( "CONF_DRIVER", OUTPUT_DIRECTSOUND );
define( "CONF_BUFFER_SIZE", 100 ); // FMOD buffer size for channelmixing.
define( "CONF_BUFFER_TIMING", 150 ); // time between stream updates/request data (milliseconds)
define( "CONF_NETBUFFER_SIZE", 64000 ); // size in bytes (def: 64000)
define( "CONF_PREBUFFER", 30 ); // how much to buffer on first opening (percent)
define( "CONF_REBUFFER", 30 ); // how much to rebuffer once underun happend (percent)

// Interger Returns
define( 'STREAM_FAILED', 0 ); // return of streamOpen if failed
define( 'STREAM_NOT_LOADED', 0 ); // state: no stream is opened
define( 'STREAM_LOADED', 1 ); // state: stream openend successful
define( 'CHANNEL_FAILED', -1 );
define( 'INVALID_FXID', -1 );

// Streamstate
define( 'STREAM_STATE_PLAYING', 1 );
define( 'STREAM_STATE_STOPPED', 0 );
define( 'STREAM_STATE_CLOSED', -1 );

// Openstates for fmod_StreamOpenState
define( 'STREAM_OPENSTATE_READY', 0 ); // stream is opened and ready.
define( 'STREAM_OPENSTATE_INVALID', -1 ); // stream handle passed in is invalid.
define( 'STREAM_OPENSTATE_OPENING', -2 ); // stream is still opening or performing a SetSubStream command.
define( 'STREAM_OPENSTATE_FAILED', -3 ); // stream failed to open. (file not found, out of memory or other error).
define( 'STREAM_OPENSTATE_CONNECT', -4 ); //connecting to remote host (internet streams only)
define( 'STREAM_OPENSTATE_BUFFERING', -5); // stream is buffering data (internet streams only)

// InitFlag
define( "FSOUND_INIT_USEDEFAULTMIDISYNTH", 1 ); // Causes MIDI playback to force software decoding.
define( "FSOUND_INIT_GLOBALFOCUS", 2 ); // For DirectSound output - sound is not muted when window is out of focus.
define( "FSOUND_INIT_ENABLESYSTEMCHANNELFX", 4 ); // For DirectSound output - Allows FSOUND_FX api to be used on global software mixer output!
define( "FSOUND_INIT_ACCURATEVULEVELS", 6 ); // This latency adjusts FSOUND_GetCurrentLevels, but incurs a small cpu and memory hit
define( "FSOUND_INIT_DONTLATENCYADJUST", 128 ); // Callbacks are not latency adjusted, and are called at mix time.  Also information functions are immediate

// Outputtypes
define( "FSOUND_OUTPUT_NOSOUND", 0 ); // NoSound driver, all calls to this succeed but do nothing.
define( "FSOUND_OUTPUT_WINMM", 1 ); // Windows Multimedia driver.
define( "FSOUND_OUTPUT_DSOUND", 2 ); // DirectSound driver.  You need this to get EAX2 or EAX3 support, or FX api support.
define( "FSOUND_OUTPUT_A3D", 4 ); // A3D driver.

// Channel Flags
define( "FSOUND_FREE", -1 ); // definition for dynamically allocated channel or sample
define( "FSOUND_UNMANAGED", -2 ); // definition for allocating a sample that is NOT managed by fsound
define( "FSOUND_ALL", -3 ); // for a channel index or sample index, this flag affects ALL channels or samples available!  Not supported by all functions.
define( "FSOUND_STEREOPAN", -1 ); // definition for full middle stereo volume on both channels
define( "FSOUND_SYSTEMCHANNEL", -1000 ); // special channel ID for channel based functions that want to alter the global FSOUND software mixing output channel
define( "FSOUND_SYSTEMSAMPLE", -1000 ); // special sample ID for all sample based functions that want to alter the global FSOUND software mixing output sample

// Effects
define( "FSOUND_FX_CHORUS", 1 ); // Chorus
define( "FSOUND_FX_COMPRESSOR", 2 ); // Compressor
define( "FSOUND_FX_DISTORTION", 3 ); // Distortion
define( "FSOUND_FX_ECHO", 4 ); // Echo
define( "FSOUND_FX_FLANGER", 5 ); // Flanger
define( "FSOUND_FX_GARGLE", 6 ); // Gargle
define( "FSOUND_FX_I3DL2REVERB", 7 ); // I3DL2 Reverb
define( "FSOUND_FX_PARAMEQ", 8 ); // Parametic Equalizer
define( "FSOUND_FX_WAVES_REVERB", 9 ); // Wave Re

// Mixer Flags
define( "FSOUND_MIXER_QUALITY_AUTODETECT", 5 ); // All platforms - Autodetect the fastest quality mixer based on your cpu.
define( "FSOUND_MIXER_QUALITY_FPU", 6 ); //  Win32/Linux only - Interpolating/volume ramping FPU mixer.
define( "FSOUND_MIXER_QUALITY_MMXP5", 7 ); //  Win32/Linux only - Interpolating/volume ramping FPU mixer.
define( "FSOUND_MIXER_QUALITY_MMXP6", 8 ); //  Win32/Linux only - Interpolating/volume ramping ppro+ MMX mixer.

// Speakermodes
define( "FSOUND_SPEAKERMODE_DOLBYDIGITAL", 1 ); // The audio is played through a speaker arrangement of surround speakers with a subwoofer.
define( "FSOUND_SPEAKERMODE_HEADPHONE", 2 ); // The speakers are headphones.
define( "FSOUND_SPEAKERMODE_MONO", 3 ); // The speakers are monaural.
define( "FSOUND_SPEAKERMODE_QUAD", 4 ); // The speakers are quadraphonic.
define( "FSOUND_SPEAKERMODE_STEREO", 5 ); // The speakers are stereo (default value).
define( "FSOUND_SPEAKERMODE_SURROUND", 6 ); // The speakers are surround sound.
define( "FSOUND_SPEAKERMODE_DTS", 7 ); // The audio is played through a speaker arrangement of surround speakers with a subwoofer.

// DSP Priorities
define( "FSOUND_DSP_DEFAULTPRIORITY_CLEARUNIT", 0 ); // DSP CLEAR unit - done first
define( "FSOUND_DSP_DEFAULTPRIORITY_SFXUNIT", 100 ); // DSP SFX unit - done second
define( "FSOUND_DSP_DEFAULTPRIORITY_MUSICUNIT", 200 ); // DSP MUSIC unit - done third
define( "FSOUND_DSP_DEFAULTPRIORITY_USER", 300 ); // User priority, use this as reference for your own dsp units
define( "FSOUND_DSP_DEFAULTPRIORITY_FFTUNIT", 900 ); // This reads data for FSOUND_DSP_GetSpectrum, so it comes after user units
define( "FSOUND_DSP_DEFAULTPRIORITY_CLIPANDCOPYUNIT", 1000 ); // DSP CLIP AND COPY unit - last

// Driver Capabilities
define( "FSOUND_CAPS_HARDWARE", 1 ); // This driver supports hardware accelerated 3d sound.
define( "FSOUND_CAPS_EAX2", 2 ); // This driver supports EAX 2 reverb
define( "FSOUND_CAPS_EAX3", 16 ); // This driver supports EAX 3 reverb

// Mode Flags
define( "FSOUND_LOOP_OFF", 1 ); // For non looping samples.
define( "FSOUND_LOOP_NORMAL", 2 ); // For forward looping samples.
define( "FSOUND_LOOP_BIDI", 4 ); // For bidirectional looping samples. (no effect if in hardware).
define( "FSOUND_8BITS", 8 ); // For 8 bit samples.
define( "FSOUND_16BITS", 16 ); // For 16 bit samples.
define( "FSOUND_MONO", 32 ); // For mono samples.
define( "FSOUND_STEREO", 64 ); // For stereo samples.
define( "FSOUND_UNSIGNED", 128 ); // For source data containing unsigned samples.
define( "FSOUND_SIGNED", 256 ); // For source data containing signed data.
define( "FSOUND_DELTA", 512 ); // For source data stored as delta values.
define( "FSOUND_IT214", 1024 ); // For source data stored using IT214 compression.
define( "FSOUND_IT215", 2048 ); // For source data stored using IT215 compression.
define( "FSOUND_HW3D", 4096 ); // Attempts to make samples use 3d hardware acceleration. (if the card supports it)
define( "FSOUND_2D", 8192 ); // Ignores any 3d processing. overrides FSOUND_HW3D. Located in software.
define( "FSOUND_STREAMABLE", 16384 ); // For realtime streamable samples. If you dont supply this sound may come out corrupted.
define( "FSOUND_LOADMEMORY", 32768 ); // For FSOUND_Sample_Load - name will be interpreted as a pointer to data
define( "FSOUND_LOADRAW", 65536 ); // For FSOUND_Sample_Load/FSOUND_Stream_Open - will ignore file format and treat as raw pcm.
define( "FSOUND_MPEGACCURATE", 131072 ); // For FSOUND_Stream_Open - scans MP2/MP3 (VBR also) for accurate FSOUND_Stream_GetLengthMs/FSOUND_Stream_SetTime.
define( "FSOUND_FORCEMONO", 262144 ); // For forcing stereo streams and samples to be mono - needed with FSOUND_HW3D - incurs speed hit
define( "FSOUND_HW2D", 524288 ); // 2d hardware sounds. allows hardware specific effects
define( "FSOUND_ENABLEFX", 1048576 ); // Allows DX8 FX to be played back on a sound. Requires DirectX 8 - Note these sounds cant be played more than once, or have a changing frequency
define( "FSOUND_MPEGHALFRATE", 2097152 ); // For FMODCE only - decodes mpeg streams using a lower quality decode, but faster execution
define( "FSOUND_NONBLOCKING", 16777216 ); // For FSOUND_Stream_Open - Causes stream to open in the background and not block the foreground app - stream plays only when ready.
define( "FSOUND_STREAM_NET", 2147483648 ); // Specifies an internet stream

define( "FSOUND_NORMAL", ( FSOUND_16BITS | FSOUND_SIGNED | FSOUND_MONO ) );


/**
 * FMOD Library Wrapper for WinBinder
 *
 * @version 0.1
 * @author Kjell Bublitz <m3nt0r.de@gmail.com>
 * @copyright 2005-2006 K. Bublitz, m3nt0r.de
*/
class FmodLibrary
{
    var $fmodLibFunc; // Fmod functions-address array
    var $fmodLastErrorMsg; // contains the last error message on function failure

    /**
     * fmod_LoadLibrary
     *
     * Loads the fmod.dll from current directorie and
     * creates an array of function-addresses.
     *
     * @access protected
    */
    function fmodlib_LoadLibrary()
    {
        $fmodLib = wb_load_library( "fmod.dll" );

        if ( $fmodLib ) {
            $this->fmodLibFunc['init'] = wb_get_function_address( "FSOUND_Init", $fmodLib );
            $this->fmodLibFunc['close'] = wb_get_function_address( "FSOUND_Close", $fmodLib );

            $this->fmodLibFunc['sound_playEx'] = wb_get_function_address( "FSOUND_PlaySoundEx", $fmodLib );
            $this->fmodLibFunc['sound_stop'] = wb_get_function_address( "FSOUND_StopSound", $fmodLib );

            $this->fmodLibFunc['setbuffer'] = wb_get_function_address( "FSOUND_SetBufferSize", $fmodLib );
            $this->fmodLibFunc['setmixer'] = wb_get_function_address( "FSOUND_SetMixer", $fmodLib );
            $this->fmodLibFunc['setoutput'] = wb_get_function_address( "FSOUND_SetOutput", $fmodLib );
            $this->fmodLibFunc['setpaused'] = wb_get_function_address( "FSOUND_SetPaused", $fmodLib );
            $this->fmodLibFunc['setpan'] = wb_get_function_address( "FSOUND_SetPan", $fmodLib );
            $this->fmodLibFunc['sourround'] = wb_get_function_address( "FSOUND_SetSurround", $fmodLib );
            $this->fmodLibFunc['setmute'] = wb_get_function_address( "FSOUND_SetMute", $fmodLib );
            $this->fmodLibFunc['setvol'] = wb_get_function_address( "FSOUND_SetVolume", $fmodLib );
            $this->fmodLibFunc['setdrv'] = wb_get_function_address( "FSOUND_SetDriver", $fmodLib );

            $this->fmodLibFunc['getvol'] = wb_get_function_address( "FSOUND_GetVolume", $fmodLib );
            $this->fmodLibFunc['getoutput'] = wb_get_function_address( "FSOUND_GetOutput", $fmodLib );
            $this->fmodLibFunc['getdrv'] = wb_get_function_address( "FSOUND_GetDriver", $fmodLib );
            $this->fmodLibFunc['getnumdrv'] = wb_get_function_address( "FSOUND_GetNumDrivers", $fmodLib );
            $this->fmodLibFunc['getdrvcaps'] = wb_get_function_address( "FSOUND_GetDriverCaps", $fmodLib );
            $this->fmodLibFunc['getdrvname'] = wb_get_function_address( "FSOUND_GetDriverName", $fmodLib );
            $this->fmodLibFunc['geterr'] = wb_get_function_address( "FSOUND_GetError", $fmodLib );

            $this->fmodLibFunc['fx_disable'] = wb_get_function_address( "FSOUND_FX_Disable", $fmodLib );
            $this->fmodLibFunc['fx_enable'] = wb_get_function_address( "FSOUND_FX_Enable", $fmodLib );
            $this->fmodLibFunc['fx_seteq'] = wb_get_function_address( "FSOUND_FX_SetParamEQ", $fmodLib );
            $this->fmodLibFunc['fx_setchor'] = wb_get_function_address( "FSOUND_FX_SetChorus", $fmodLib );
            $this->fmodLibFunc['fx_setcomp'] = wb_get_function_address( "FSOUND_FX_SetCompressor", $fmodLib );
            $this->fmodLibFunc['fx_setdist'] = wb_get_function_address( "FSOUND_FX_SetDistortion", $fmodLib );
            $this->fmodLibFunc['fx_setecho'] = wb_get_function_address( "FSOUND_FX_SetEcho", $fmodLib );
            $this->fmodLibFunc['fx_setflangr'] = wb_get_function_address( "FSOUND_FX_SetFlanger", $fmodLib );
            $this->fmodLibFunc['fx_setgargle'] = wb_get_function_address( "FSOUND_FX_SetGargle", $fmodLib );
            $this->fmodLibFunc['fx_setreverb'] = wb_get_function_address( "FSOUND_FX_SetI3DL2Reverb", $fmodLib );
            $this->fmodLibFunc['fx_setwavrev'] = wb_get_function_address( "FSOUND_FX_SetWavesReverb", $fmodLib );

            $this->fmodLibFunc['strm_open'] = wb_get_function_address( "FSOUND_Stream_Open", $fmodLib );
            $this->fmodLibFunc['strm_play'] = wb_get_function_address( "FSOUND_Stream_PlayEx", $fmodLib );
            $this->fmodLibFunc['strm_close'] = wb_get_function_address( "FSOUND_Stream_Close", $fmodLib );
            $this->fmodLibFunc['strm_stop'] = wb_get_function_address( "FSOUND_Stream_Stop", $fmodLib );
            $this->fmodLibFunc['strm_create'] = wb_get_function_address( "FSOUND_Stream_Create", $fmodLib );
            $this->fmodLibFunc['strm_bsize'] = wb_get_function_address( "FSOUND_Stream_SetBufferSize", $fmodLib );
            $this->fmodLibFunc['strm_getlen'] = wb_get_function_address( "FSOUND_Stream_GetLengthMs", $fmodLib );
            $this->fmodLibFunc['strm_gettime'] = wb_get_function_address( "FSOUND_Stream_GetTime", $fmodLib );
            $this->fmodLibFunc['strm_getpos'] = wb_get_function_address( "FSOUND_Stream_GetPosition", $fmodLib );
            $this->fmodLibFunc['strm_netbuf'] = wb_get_function_address( "FSOUND_Stream_Net_SetBufferProperties", $fmodLib );
            $this->fmodLibFunc['strm_netmeta'] = wb_get_function_address( "FSOUND_Stream_Net_SetMetadataCallback", $fmodLib );
            $this->fmodLibFunc['strm_netlast'] = wb_get_function_address( "FSOUND_Stream_Net_GetLastServerStatus", $fmodLib );
            $this->fmodLibFunc['strm_netstat'] = wb_get_function_address( "FSOUND_Stream_Net_GetStatus", $fmodLib );
            $this->fmodLibFunc['strm_nettime'] = wb_get_function_address( "FSOUND_Stream_Net_SetTimeout", $fmodLib );
            $this->fmodLibFunc['strm_getstate'] = wb_get_function_address( "FSOUND_Stream_GetOpenState", $fmodLib );
            $this->fmodLibFunc['strm_gettags'] = wb_get_function_address( "FSOUND_Stream_GetNumTagFields", $fmodLib );
            $this->fmodLibFunc['strm_findtag'] = wb_get_function_address( "FSOUND_Stream_FindTagField", $fmodLib );
            $this->fmodLibFunc['strm_gettag'] = wb_get_function_address( "FSOUND_Stream_GetTagField", $fmodLib );
            $this->fmodLibFunc['strm_getbytes'] = wb_get_function_address( "FSOUND_Stream_GetLength", $fmodLib );

            $this->fmodLibFunc['smp_load'] = wb_get_function_address( "FSOUND_Sample_Load", $fmodLib );
            $this->fmodLibFunc['smp_alloc'] = wb_get_function_address( "FSOUND_Sample_Alloc", $fmodLib );
            $this->fmodLibFunc['smp_lock'] = wb_get_function_address( "FSOUND_Sample_Lock", $fmodLib );
            $this->fmodLibFunc['smp_free'] = wb_get_function_address( "FSOUND_Sample_Free", $fmodLib );
            $this->fmodLibFunc['smp_unlock'] = wb_get_function_address( "FSOUND_Sample_Unlock", $fmodLib );
            $this->fmodLibFunc['smp_getlen'] = wb_get_function_address( "FSOUND_Sample_GetLength", $fmodLib );
            $this->fmodLibFunc['smp_getdef'] = wb_get_function_address( "FSOUND_Sample_GetDefaults", $fmodLib );

            $this->fmodLibFunc['rec_getdrv'] = wb_get_function_address( "FSOUND_Record_GetDriver", $fmodLib );
            $this->fmodLibFunc['rec_getdrvn'] = wb_get_function_address( "FSOUND_Record_GetDriverName", $fmodLib );
            $this->fmodLibFunc['rec_getnumdrv'] = wb_get_function_address( "FSOUND_Record_GetNumDrivers", $fmodLib );
            $this->fmodLibFunc['rec_getpos'] = wb_get_function_address( "FSOUND_Record_GetPosition", $fmodLib );
            $this->fmodLibFunc['rec_setdrv'] = wb_get_function_address( "FSOUND_Record_SetDriver", $fmodLib );
            $this->fmodLibFunc['rec_start'] = wb_get_function_address( "FSOUND_Record_StartSample", $fmodLib );
            $this->fmodLibFunc['rec_stop'] = wb_get_function_address( "FSOUND_Record_Stop", $fmodLib );
        }
    }

    function fmodlib_SoundInit($mixrate, $softchannels, $flags)
    {
        return wb_call_function( $this->fmodLibFunc['init'], array( $mixrate, $softchannels, $flags ) );
    }

    function fmodlib_CloseStream( $stream )
    {
        return wb_call_function( $this->fmodLibFunc['strm_close'], array( $stream ) );
    }

    function fmodlib_OpenStream( $streamUrl, $modes )
    {
        return wb_call_function( $this->fmodLibFunc['strm_open'], array( $streamUrl, $modes, 0, 0 ) );
    }

    function fmodlib_SoundClose()
    {
        return wb_call_function( $this->fmodLibFunc['close'], array() );
    }

    function fmodlib_StreamBuffer( $buffersize )
    {
        return wb_call_function( $this->fmodLibFunc['strm_bsize'], array( $buffersize ) );
    }

    function fmodlib_StreamNetBuffer( $buffersize, $prebuffer, $rebuffer )
    {
        return wb_call_function( $this->fmodLibFunc['strm_netbuf'], array( $buffersize, $prebuffer, $rebuffer ) );
    }

    function fmodlib_SetDriver( $driverid )
    {
        return wb_call_function( $this->fmodLibFunc['setdrv'], array( $driverid ) );
    }

    function fmodlib_SetOutput( $outputid )
    {
        return wb_call_function( $this->fmodLibFunc['setoutput'], array( $outputid ) );
    }

    function fmodlib_SetMixer( $mixertype )
    {
        return wb_call_function( $this->fmodLibFunc['setmixer'], array( $mixertype ) );
    }

    function fmodlib_SetBuffer( $buffersize )
    {
        return wb_call_function( $this->fmodLibFunc['setbuffer'], array( $buffersize ) );
    }

    function fmodlib_StreamGetState( $stream )
    {
        return wb_call_function( $this->fmodLibFunc['strm_getstate'], array(  $stream ) );
    }

    function fmodlib_StreamPlayEx( $channel, $stream, $dspunit, $paused )
    {
        return wb_call_function( $this->fmodLibFunc['strm_play'], array( $channel, $stream, $dspunit, $paused ) );
    }

    function fmodlib_StreamStop( $stream )
    {
        return wb_call_function( $this->fmodLibFunc['strm_stop'], array( $stream ) );
    }

    function fmodlib_ChannelPause( $channel, $state )
    {
        return wb_call_function( $this->fmodLibFunc['setpaused'], array( $channel, $state ) );
    }

    function fmodlib_ChannelMute( $channel, $state )
    {
         return wb_call_function( $this->fmodLibFunc['setmute'], array( $channel, $state ) );
    }

    function fmodlib_FxEnable( $channel, $fxFlag )
    {
        return wb_call_function( $this->fmodLibFunc['fx_enable'], array( $channel, $fxFlag ) );
    }

    function fmodlib_GetNetStatus( $stream, $status, $buffer, $bitrate, $flags )
    {
        return wb_call_function( $this->fmodLibFunc['strm_netstat'], array( $stream, $status, $buffer, $bitrate, $flags ) );
    }

    function fmodlib_FxSetParamEQ( $fxid, $band, $bandwidth, $gain )
    {
        return wb_call_function( $this->fmodLibFunc['fx_seteq'], array( $fxid, $band, $bandwidth, $gain ) );
    }

    function fmodlib_ChannelPan( $channel, $value )
    {
        return wb_call_function( $this->fmodLibFunc['setpan'], array( $channel, $value ) );
    }

    function fmodlib_SetChannelVolumen( $channel, $value )
    {
        return wb_call_function( $this->fmodLibFunc['setvol'], array( $channel, $value ) );
    }

    function fmodlib_PseudoSurround( $channel, $state )
    {
        return wb_call_function( $this->fmodLibFunc['sourround'], array( $channel, $state ) );
    }

    function fmodlib_GetOutputType()
    {
        return wb_call_function( $this->fmodLibFunc['getoutput'], array() );
    }

    function fmodlib_GetNumDrivers()
    {
        return wb_call_function( $this->fmodLibFunc['getnumdrv'], array() );
    }

    function fmodlib_GetNumTags( $stream, $valuepointer )
    {
        return wb_call_function( $this->fmodLibFunc['strm_gettags'], array( $stream, $valuepointer ) );
    }

    function fmodlib_GetPositionBytes( $stream )
    {
        return wb_call_function( $this->fmodLibFunc['strm_getpos'], array( $stream ) );
    }

    function fmodlib_GetPositionMs( $stream )
    {
        return wb_call_function( $this->fmodLibFunc['strm_gettime'], array( $stream ) );
    }

    function fmodlib_GetLenghtMs( $stream )
    {
        return wb_call_function( $this->fmodLibFunc['strm_getlen'], array( $stream ) );
    }

    function fmodlib_GetLenght( $stream )
    {
        return wb_call_function( $this->fmodLibFunc['strm_getbytes'], array( $stream ) );
    }

    function fmodlib_GetChannelVolumen( $channel )
    {
        return wb_call_function( $this->fmodLibFunc['getvol'], array( $channel ) );
    }

    function fmodlib_GetStreamTag( $stream, $tagIndex,  $type_ptr, $name_ptr, $value_ptr, $lenght_ptr )
    {
        return wb_call_function( $this->fmodLibFunc['strm_gettag'], array( $stream, $tagIndex, $type_ptr, $name_ptr, $value_ptr, $lenght_ptr ) );
    }

    /**
     * fmodlib_GetErrorMessage
     * To be called right after a library function was executed. If the function
     * call fails, then this function will read the error-id and return the
     * string accordingly.
     *
     * @return string Error Message
     * @access private
    */
    function fmodlib_GetErrorMessage()
    {
        $fmoderr = wb_call_function( $this->fmodLibFunc['geterr'], array() );

        switch ( $fmoderr )
        {
            case 1: $err = "Cannot call this command after FSOUND_Init. Call FSOUND_Close first. "; break;
            case 2: $err = "This command failed because FSOUND_Init or FSOUND_SetOutput was not called "; break;
            case 3: $err = "Error initializing output device."; break;
            case 4: $err = "Error initializing output device, but more specifically, \nthe output device is already in use and cannot be reused."; break;
            case 5: $err = "Playing the sound failed."; break;
            case 6: $err = "Soundcard does not support the features needed for this soundsystem (16bit stereo output) "; break;
            case 7: $err = "Error setting cooperative level for hardware. "; break;
            case 8: $err = "Error creating hardware sound buffer. "; break;
            case 9: $err = "File not found"; break;
            case 10: $err = "Unknown file format"; break;
            case 11: $err = "Error loading file"; break;
            case 12: $err = "Not enough memory or resources "; break;
            case 13: $err = "The version number of this file format is not supported"; break;
            case 14: $err = "An invalid parameter was passed to this function"; break;
            case 15: $err = "Tried to use an EAX command on a non EAX enabled channel or output. "; break;
            case 16: $err = "Failed to allocate a new channel "; break;
            case 17: $err = "Recording is not supported on this machine "; break;
            case 18: $err = "Windows Media Player not installed so cannot play wma or use internet streaming."; break;
            case 19: $err = "An error occured trying to open the specified CD device "; break;
            default: $err = false; break;
        }

        return $err;
    }

}

/**
 * FMOD Audio Class for WinBinder
 *
 * @version 0.3e
 * @author Kjell Bublitz <m3nt0r.de@gmail.com>
 * @copyright 2005-2006 K. Bublitz, m3nt0r.de
*/
class FmodAudio extends FmodLibrary
{
    var $fmodStream; // Stream handler
    var $fmodOutputType; // output driver integer or string.
    var $fmodChannel; // Internal Channel-ID
    var $fmodSurroundEnabled; // bool: 1 means fake sourround is active
    var $fmodFxId; // Internal FX-ID
    var $fmodDriver;

    var $fmodStreamUrl; // Filepath or URI to media
    var $fmodStreamState; // 1 means playing, 0 means stopped, -1 means closed
    var $fmodStreamOpen; // 1 means fmodStreamUrl could be opened/loaded
    var $fmodIsPaused; // bool: 1 means paused
    var $fmodIsMuted; // bool: 1 means muted
    var $fmodNetStatus; // array containing some data about the network status


    function FmodAudio()
    {
        $this->fmodStream = STREAM_FAILED;
        $this->fmodIsPaused = false;
        $this->fmodIsMuted = false;
        $this->fmodStreamState = STREAM_STATE_CLOSED;
        $this->fmodSurroundEnabled = false;
        $this->fmodLastErrorMsg = "";
        $this->fmodStreamOpen = STREAM_NOT_LOADED;
        $this->fmodNetStatus = array();
        $this->fmodOutputType = CONF_DRIVER;
        $this->fmodDriver = 0;

        parent::fmodlib_LoadLibrary();
    }

    /**
     * fmod_SoundInit
     * Initialize the sounddriver and setup various options for playback
     *
     * @param int $mixrate specifies the mixingrate on which the stream should operate, default is 44100khz
     * @param int $softchannels number of active software channels, default is 16
     * @return bool TRUE on success, FALSE on failure (while filling $fmodLastErrorMsg)
     * @access public
    */
    function fmod_SoundInit( $mixrate = 44100, $softchannels = 16, $flags = 0 )
    {
        $this->fmodlib_SetOutput( $this->fmodOutputType );
        $this->fmodlib_SetDriver( $this->fmodDriver );
        $this->fmodlib_SetMixer( FSOUND_MIXER_QUALITY_FPU );
        $this->fmodlib_SetBuffer( CONF_BUFFER_SIZE );

        $result = $this->fmodlib_SoundInit($mixrate, $softchannels, $flags);

        if ( $result ) {
            $this->fmodlib_StreamBuffer( CONF_BUFFER_TIMING );
            $this->fmodlib_StreamNetBuffer( CONF_NETBUFFER_SIZE, CONF_PREBUFFER, CONF_REBUFFER );
        }

        return $result;
    }

    /**
     * fmod_SoundClose
     * This function closes the entire fmod soundsystem which was previously initialized
     * by SoundInit
     *
     * @return bool True on success, False on failure
     * @access public
    */
    function fmod_SoundClose()
    {
        return $this->fmodlib_SoundClose();
    }

    /**
     * fmod_StreamOpen
     * Opens a filepath or a URL to a mediasource and creates a stream handle.
     *
     * @param string $url Path or URL to a mediafile / source
     * @return bool TRUE on success, FALSE on failure (while filling $fmodLastErrorMsg)
     * @access public
    */
    function fmod_StreamOpen( $url = '' )
    {
        $result = false;
        $this->fmodStreamOpen = STREAM_NOT_LOADED;

        if ( !empty( $url ) ) {
            $this->fmodStreamUrl = $url;
        }

        $this->fmodlib_CloseStream( $this->fmodStream );
        $this->fmodStream = $this->fmodlib_OpenStream( $this->fmodStreamUrl, FSOUND_ENABLEFX );

        if ( $this->fmodStream ) {
            $this->fmodStreamOpen = STREAM_LOADED;
            $result = true;
        }

        return $result;
    }



    /**
     * fmod_StreamClose
     * Closes current stream handle
     *
     * @return bool TRUE on success, changes fmodStreamState
     * @access public
    */
    function fmod_StreamClose()
    {
        $result = $this->fmodlib_CloseStream( $this->fmodStream );

        if ( $result ) {
            $this->fmodStreamState = STREAM_STATE_CLOSED;
        }

        return $result;
    }


    /**
     * fmod_StreamPlay
     * Plays the current stream handle
     *
     * @return bool TRUE on success, changes fmodStreamState, FALSE on failure
     * @access public
    */
    function fmod_StreamPlay()
    {
        $result = $this->fmodlib_StreamPlayEx(FSOUND_FREE, $this->fmodStream, 0, true);

        if ( $result == CHANNEL_FAILED ) {
            $result = false;
            $this->fmodLastErrorMsg = $this->fmodlib_GetErrorMessage();
        }
        else {
            $this->fmodChannel = $result;
            $this->fmodlib_ChannelPause( $this->fmodChannel, false );
            /*
            $this->fmodlib_ChannelPause( FSOUND_SYSTEMCHANNEL, true );
            $this->fmodFxId = $this->fmodlib_FxEnable( FSOUND_SYSTEMCHANNEL, FSOUND_FX_PARAMEQ );
            $this->fmodlib_ChannelPause( FSOUND_SYSTEMCHANNEL, false );
            $this->fmodlib_ChannelPause( $this->fmodChannel, false );
            */
            $this->fmodStreamState = STREAM_STATE_PLAYING;
            $result = true;
        }

        return $result;
    }

    /**
     * fmod_StreamStop
     * Stops the current stream
     *
     * @return bool TRUE on success, changes fmodStreamState, FALSE on failure
     * @access public
    */
    function fmod_StreamStop()
    {

        $this->fmodStreamState = STREAM_STATE_STOPPED;
        $result = $this->fmodlib_StreamStop( $this->fmodStream );

        if ( !$result ) {
            $this->fmodLastErrorMsg = $this->fmodlib_GetErrorMessage();
        }

        return $result;
    }

    /**
     * fmod_StreamReload
     * Reloads the current StreamUrl
     *
     * @access public
    */
    function fmod_StreamReload() {

        $this->fmod_StreamStop();

        if ( $this->fmodlib_CloseStream() ) {
            $this->fmod_StreamOpen( $this->fmodStreamUrl );
            $this->fmod_StreamPlay();
        }
    }

    /**
     * fmod_SoundPause
     * Pauses the playback on current channel
     *
     * @param bool $state True pauses, False unpauses
     * @access public
    */
    function fmod_SoundPause( $state )
    {
        $this->fmodIsPaused = true;

        $result = $this->fmodlib_ChannelPause( $this->fmodChannel, $state );

        if ( !$state ) {
            $this->fmodIsPaused = false;
        }

        return $result;
    }

    /**
     * fmod_SoundMute
     * Mutes the output on current channel
     *
     * @param bool $state True mutes, False unmutes
     * @access public
    */
    function fmod_SoundMute( $state )
    {
        $this->fmodIsMuted = true;

        $result = $this->fmodlib_ChannelMute( $this->fmodChannel, $state );

        if ( !$state ) {
            $this->fmodIsMuted = false;
        }

        return $result;
    }

    /**
     * fmod_SetSurround
     * Enables pseudo Sourround effect basicly every soundcard provides (3D)
     *
     * @param bool $state True pauses, False unpauses
     * @access public
    */
    function fmod_SetSurround( $state )
    {
        $this->fmodSurroundEnabled = true;

        $result = $this->fmodlib_PseudoSurround( $this->fmodChannel, $state );

        if ( !$state ) {
            $this->fmodSurroundEnabled = false;
        }

        return $result;
    }


    /**
     * fmod_SetEqLevel
     *
     * @return bool True on success, False on failure (filling $fmodLastErrorMsg)
     * @access public
     */
    function fmod_SetEqLevel( $band = '', $gain = '0', $bandwidth = '18' )
    {
        $result = $this->fmodlib_FxSetParamEQ( $this->fmodFxId, $band, $bandwidth, $gain );

        if ( !$result ) {
            $this->fmodLastErrorMsg = 'The EQ Setting was invalid';
        }

        return $result;
    }

    /**
     * fmod_SetPanning
     *
     * @param int $pos Value in a range between 0 and 255, where 0 is left and 255 is right, default is 127(center)
     * @return bool True on success, False on Failure
     * @access public
    */
    function fmod_SetPanning( $pos = '127' )
    {
        return $this->fmodlib_ChannelPan( $this->fmodChannel, $pos );
    }

    /**
     * fmod_SetVolumen
     *
     * @param int $vol Value in a range between 0 and 255, where 255 is maximum (loudest)
     * @return bool True on success, False on Failure
     * @access public
    */
    function fmod_SetVolumen( $vol )
    {
        return $this->fmodlib_SetChannelVolumen( $this->fmodChannel, $vol );
    }

    /**
     * fmod_GetVolumen
     *
     * @return int Current volumen level (From 0 to 255);
     * @access public
    */
    function fmod_GetVolumen()
    {
        return $this->fmodlib_GetChannelVolumen( $this->fmodChannel );
    }

    /**
     * fmod_GetBytes
     *
     * This function is not supported for URL based streams over the internet or CDDA streams
     *
     * @return On success, the current stream's position in BYTES is returned. On failure, 0 is returned.
     * @access public
    */
    function fmod_GetBytes()
    {
        return $this->fmodlib_GetPositionBytes( $this->fmodStream );
    }

    /**
     * fmod_GetLenghtBytes
     *
     * @return bool On success, the size of the stream in BYTES is returned.
     * @access public
    */
    function fmod_GetLenghtBytes()
    {
        return $this->fmodlib_GetLenght( $this->fmodStream );
    }

    /**
     * fmod_GetTime
     *
     * @param bool $return_time If set to false milliseconds will be returned. Default is timeformat.
     * @return bool On success, the current stream's position in milliseconds is returned.
     * @access public
    */
    function fmod_GetTime( $return_time = true )
    {

        if( $return_time ) {
            $result = $this->fmod_Msec2Time( $this->fmodlib_GetPositionMs( $this->fmodStream ) );
        } else {
            $result =  $this->fmodlib_GetPositionMs( $this->fmodStream );
        }

        return  $this->fmodlib_GetPositionMs( $this->fmodStream );
    }


    /**
     * fmod_GetLenght
     *
     * @param bool $return_time If set to false milliseconds will be returned. Default is timeformat.
     * @return bool On success, the size of the stream in MILLISECONDS is returned.
     * @access public
    */
    function fmod_GetLenght( $return_time = true )
    {
        if( $return_time ) {
            $result = $this->fmod_Msec2Time( $this->fmodlib_GetLenghtMs( $this->fmodStream ) );
        } else {
            $result = $this->fmodlib_GetLenghtMs( $this->fmodStream );
        }

        return $result;
    }

    /**
     * fmod_GetOutputName
     *
     * @return string Name of current used output
     * @access public
    */
    function fmod_GetOutputName()
    {
        switch ( $this->fmodlib_GetOutputType() )
        {
            case 0: $output = "No Sound"; break;
            case 1: $output = "Windows MultiMedia"; break;
            case 2: $output = "Direct Sound"; break;
            case 3: $output = "Aureal 3D"; break;
            case 7: $output = "ASIO"; break;
            default: $output = "Unkown"; break;
        }

        return $output;
    }

    /**
     * fmod_TagType
     *
     * Make the tagtype humanreadable
     *
     * @param string $typestr Name of Tagtype
     * @return int The Typeid for use with TagFunctions
     * @access private
    */
    function fmod_TagType( $typestr ){

         switch ( $typestr ) {
            case "vorbis": $typeval = 0; // A vorbis comment
                break;

            case "id3v1": $typeval = 1; // Part of an ID3v1 tag
                break;

            case "id3v2": $typeval = 2; // An ID3v2 frame
                break;

            case "shoutcast": $typeval = 3; // A SHOUTcast header line
                break;

            case "icecast": $typeval = 4; // An Icecast header line
                break;

            case "asf": $typeval = 5; // An Advanced Streaming Format header line
                break;
        }

        return $typeval;
    }


    /**
     * fmod_GetNumTagFields
     * This function returns the number of Tags the file has to offer. Tags like in ID3Tags.
     *
     * @return int Number of current stream availble tags
     * @access public
    */
    function fmod_GetNumTagFields()
    {
        $intval = pack('i', 0);
        $valptr = wb_get_address( $intval );
        $result = $this->fmodlib_GetNumTags( $this->fmodStream, $valptr );
        $valarr = unpack('iNumTagFields', wb_peek($valptr, 4));

        return $valarr['NumTagFields'];
    }


    /**
     * fmod_GetTag
     *
     * Returns a array with the fieldname as key and value as val
     *
     * @param int $tagIndex Value defines the index number of the tag
     * @param string $typestr Name of Tagtype
     * @return bool FALSE on failure, Array on success (TagName as key, TagValue as val)
     * @access public
    */
    function fmod_GetTag( $tagIndex, $typestr = "shoutcast" )
    {

        $typeval = $this->fmod_TagType( $typestr );

        // create pointers
        $type = pack( 'i', $typeval ); // int, 4
        $namef = pack( 'c', '' ); // char, 1
        $value = pack( 'V', 0 ); // void, 4
        $len = pack( 'i', 0 ); // int, 4

        $type_ptr = wb_get_address( $type );
        $name_ptr = wb_get_address( $namef );
        $value_ptr = wb_get_address( $value );
        $lenght_ptr = wb_get_address( $type );

        $result = $this->fmodlib_GetStreamTag( $this->fmodStream, $tagIndex, $type_ptr, $name_ptr, $value_ptr,$lenght_ptr );

        $tagarr = unpack( 'lName', wb_peek( $name_ptr, 4 ) );
        $valarr = unpack( 'lValue', wb_peek( $value_ptr, 4 ) );
        $lenarr = unpack( 'iValueLen', wb_peek( $lenght_ptr, 4 ) );

        $tagval = wb_peek( $tagarr['Name'], 20 );
        $tag = substr( $tagval, 0, strpos( $tagval, "\0" ) );

        $return = array( $tag, strip_tags( wb_peek( $valarr['Value'], $lenarr['ValueLen'] ) ) );

        return $return;
    }

    /**
     * fmod_GetTags
     *
     * Returns a ListView formatted array
     *
     * @param string $type Value defines the type of media (id3, asf, etc.)
     * @return array All Tags and their values as Array
     * @access public
    */
    function fmod_GetTags( $type = "shoutcast" )
    {
        if ( $this->fmodStreamState != STREAM_STATE_STOPPED )
        {
            $tags = $this->fmod_GetNumTagFields();
            $streamtags = array();

            for( $i = 0; $i < $tags; $i++ )
            {
                $tag = $this->fmod_GetTag( $i, $type );
                $streamtags[$tag[0]] = $tag[1];
            }

            if ( count( $streamtags ) > 0 ) {

                ksort( $streamtags ); // sort by tag

                return $streamtags;

            } else {

                $this->fmodLastErrorMsg = 'Could not read Stream Tags';

                return false;
            }
        }
    }

    /**
     * fmod_StreamOpenState
     *
     * @return string Message describing current opening state
     * @access public
    */
    function fmod_StreamOpenState()
    {
        switch($this->fmodlib_StreamGetState())
        {
            case STREAM_OPENSTATE_READY: $stateMsg = 'Ready'; break;
            case STREAM_OPENSTATE_INVALID: $stateMsg = 'Stream is invalid'; break;
            case STREAM_OPENSTATE_OPENING: $stateMsg = 'Opening stream'; break;
            case STREAM_OPENSTATE_FAILED: $stateMsg = 'Failed to open stream'; break;
            case STREAM_OPENSTATE_CONNECT: $stateMsg = 'Connecting to remote address'; break;
            case STREAM_OPENSTATE_BUFFERING: $stateMsg = 'Buffering data'; break;
        }

        return $stateMsg;
    }

    /**
     * fmod_StreamNetState
     *
     * Gathers informations about the current netstream like buffer-progress in
     * percent, playback bitrate, datatype and status.
     *
     * @return bool
     * @access public
     */
    function fmod_StreamNetState()
    {
        $statusstr = pack('i', 0);
        $status = wb_get_address( $statusstr );

        $bufferstr = pack('i', 0);
        $buffer = wb_get_address( $bufferstr );

        $bitratestr = pack('i', 0);
        $bitrate = wb_get_address( $bitratestr );

        $flagsstr = pack('i', 0);
        $flags = wb_get_address( $flagsstr );

        $result = $this->fmodlib_GetNetStatus( $this->fmodStream, $status, $buffer, $bitrate, $flags );

        if ( $result )
        {
            $bitrate_array = unpack( 'iBitrate', wb_peek( $bitrate, 4 ) );
            $buffer_array = unpack( 'iBuffer', wb_peek( $buffer, 4 ) );
            $status_array = unpack( 'iStatus', wb_peek( $status, 4 ) );
            $flags_array = unpack( 'iFlags', wb_peek( $flags, 4 ) );

            $netReturn['buffer'] = $buffer_array['Buffer'] . "%";
            $netReturn['bitrate'] = $bitrate_array['Bitrate'];
            $netReturn['status'] = $status_array['Status'];

            switch ( $status_array['Status'] )
            {
                case 1: $netReturn['statustext'] = 'Not Connected';
                    break;
                case 2: $netReturn['statustext'] = 'Connecting';
                    break;
                case 3: $netReturn['statustext'] = 'Playing';
                    break;
                case 4: $netReturn['statustext'] = 'Ready';
                    break;
                case 5: $netReturn['statustext'] = 'Error';
                    break;
            }

            switch ( $flags_array['Flags'] )
            {
                // Possible Network Resources
                case 1: $netReturn['format'] = 'Shoutcast';
                    break;
                case 2: $netReturn['format'] = 'Icecast';
                    break;
                case 4: $netReturn['format'] = 'HTTP';
                    break;

                // Stream is type of MPEG
                case 65536: $netReturn['format'] = 'MPEG';
                    break;
                case 65537: $netReturn['format'] = 'Shoutcast MPEG';
                    break;
                case 65538: $netReturn['format'] = 'Icecast MPEG';
                    break;
                case 65540: $netReturn['format'] = 'HTTP MPEG';
                    break;

                // Stream is type of OGG
                case 131072: $netReturn['format'] = 'OGG';
                    break;
                case 131073: $netReturn['format'] = 'Shoutcast OGG';
                    break;
                case 131074: $netReturn['format'] = 'Icecast OGG';
                    break;
                case 131076: $netReturn['format'] = 'HTTP OGG';
                    break;
            }

            $this->fmodNetStatus = $netReturn;
            $result = true;
        }
        else
        {
            $this->fmodLastErrorMsg = $this->fmodlib_GetErrorMessage();
        }

        return $result;
    }


    /**
     * fmod_Msec2Time
     * Converts miliseconds to time (MM:SS)
     *
     * @return string Time in the format MM:SS
     * @access private
    */
    function fmod_Msec2Time( $ms )
    {
        $seconds = floor( $ms / 1000 );
        $mins = floor( $seconds / 60 );
        $secs = $seconds - ( $mins * 60 );
        if ( $secs < 10 ) {
            $secs = "0" . $secs;
        }
        $time = $mins . ":" . $secs;

        return $time;
    }
}
?>