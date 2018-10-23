<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments Configuration File
 *
 * Set your installation BASE_URL * without the trailing slash * and the database
 * credentials in order to connect to the database. You can enable the DEBUG_MODE
 * while developing the application.
 *
 * Set the default language by changing the LANGUAGE constant. For a full list of
 * available languages look at the /application/config/config.php file.
 *
 * IMPORTANT:
 * If you are updating from version 1.0 you will have to create a new "config.php"
 * file because the old "configuration.php" is not used anymore.
 */
class Config {

    // ------------------------------------------------------------------------
    // GENERAL SETTINGS
    // ------------------------------------------------------------------------
	
    const LANGUAGE      = 'english';
    const DEBUG_MODE    = FALSE;
	
	//DEV SETTINGS
	/*const BASE_URL      = 'http://localhost:8082/nexus/deploy/ea';
	const DB_HOST       = '127.0.0.1';
    const DB_NAME       = 'nexus';
    const DB_USERNAME   = 'nexus';
    const DB_PASSWORD   = 'nexus';*/
    
	
	//PROD SEETTINGS
	const BASE_URL      = 'http://nexusea.enaebl.com';
	const DB_HOST       = '127.0.0.1';
    const DB_NAME       = 'nexusapp';
    const DB_USERNAME   = 'nexus';
    const DB_PASSWORD   = 'Carlos123,.!';

    // ------------------------------------------------------------------------
    // GOOGLE CALENDAR SYNC
    // ------------------------------------------------------------------------

    const GOOGLE_SYNC_FEATURE   = TRUE; // Enter TRUE or FALSE
    const GOOGLE_PRODUCT_NAME   = '';
    const GOOGLE_CLIENT_ID      = '';
    const GOOGLE_CLIENT_SECRET  = '';
    const GOOGLE_API_KEY        = '';
}

/* End of file config.php */
/* Location: ./config.php */
