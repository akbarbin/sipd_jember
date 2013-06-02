<?php

$config = array(
    /**
     * User validation
     */
    'user/edit_account' => array(
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'phone',
            'label' => 'Telepon',
            'rules' => 'required|min_length[6]|max_length[12]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
    ),
    'user/add' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|alpha_numeric|min_lenght[5]|is_unique[users.username]'
        ),
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'sub_district_id',
            'label' => 'Kecamatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'confirmation_password',
            'label' => 'Konfirmasi Password',
            'rules' => 'required|min_length[5]|matches[password]'
        ),
    ),
    'user/edit' => array(
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'sub_district_id',
            'label' => 'Kecamatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'confirmation_password',
            'label' => 'Konfirmasi Password',
            'rules' => 'required|min_length[5]|matches[password]'
        ),
    ),
    'user/change_password' => array(
        array(
            'field' => 'old_password',
            'label' => 'Password Lama',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password Baru',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'confirmation_password',
            'label' => 'Konfirmasi Password',
            'rules' => 'required|min_length[5]|matches[password]'
        ),
    ),
    'name_validation' => array(
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
    ),
    'name_sub_district_validation' => array(
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
        array(
            'field' => 'sub_district_id',
            'label' => 'Kecamatan',
            'rules' => 'required'
        ),
    ),
    'instance' => array(
        array(
            'field' => 'code',
            'label' => 'Kode',
            'rules' => 'required|alpha_numeric|min_lenght[5]|is_unique[instances.code]'
        ),
        array(
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required'
        ),
    ),
    'search_tabular' => array(
        array(
            'field' => 'sub_district_id',
            'label' => 'Kecamatan',
            'rules' => 'required'
        ),
        array(
            'field' => 'year',
            'label' => 'Tahun',
            'rules' => 'required'
        ),
    ),
    'profile' => array(
        array(
            'field' => 'title',
            'label' => 'Judul',
            'rules' => 'required'
        ),
    )
);
?>
