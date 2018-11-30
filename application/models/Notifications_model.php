<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
 * Notifications Model
 *
 * @package Models
 */
class Notifications_model extends CI_Model {
    
    public function add($user_id, $title, $subtitle, $headline, $status, $type) {
        $notif = [];
        $notif['user_id'] = $user_id;
        $notif['title'] = $title;
        $notif['subtitle'] = $subtitle;
        $notif['headline'] = $headline;
        $notif['created_at'] = time();
        $notif['status'] = $status;
        $notif['type'] = $type;
        
        if (!$this->db->insert('notification', $notif)) {
            throw new Exception('Could not create notification');
        }
    }

}
