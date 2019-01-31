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
 * Companies Model
 *
 * @package Models
 */
class Companies_model extends CI_Model {

    /**
     * Get the record id of a particular company.
     *
     * @param string $slug The selected role slug. Slugs are defined in the "application/config/constants.php" file.
     *
     * @return CI_Model Returns the database row.
     */
    public function find($slug) {
        return $this->db->get_where('assessment_center', ['url' => $slug])->row();
    }

    public function get_available_acs() {
        $this->load->library('session');
        $id = $this->session->userdata['user_id'];
        $res = $this->db
                        ->select('assessment_center.id, assessment_center.name')
                        ->distinct()
                        ->order_by('assessment_center.name')
                        ->from('assessment_center')
                        ->join('assessment_center_user', 'assessment_center.id = assessment_center_user.ac_id', 'inner')
                        ->where('assessment_center_user.user_id', $id)
                        ->get()->result_array();

        return $res;
    }

}
