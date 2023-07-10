<?php

require_once 'application/core/MY_Model_Interface.php';

abstract class MY_Model extends CI_Model implements MY_Model_Interface{

    private function insert($without_null){

        if($without_null == true)
        {
            foreach($this as $key=>$value)
            {
                if($value ==  null && $key != $this->{$this->get_db_table_pk()})
                    unset($this->$key);
            }
        }

        $this->db->insert($this->get_db_table(), $this);
        $this->{$this->get_db_table_pk()} = $this->db->insert_id();
        return $this->{$this->get_db_table_pk()};
    }

    private function update($without_null){

        if($without_null == true)
        {
            foreach($this as $key=>$value)
            {
                if($value ==  null && $key != $this->{$this->get_db_table_pk()})
                    unset($this->$key);
            }
        }

        $this->db->update($this->get_db_table(), $this, array(
            $this->get_db_table_pk() => $this->{$this->get_db_table_pk()}
        ));

        return $this->{$this->get_db_table_pk()};
    }

    public function save($without_null = false){

        if(isset($this->{$this->get_db_table_pk()}))
        {
            $id = $this->update($without_null);
        }
        else
        {
            $id = $this->insert($without_null);
        }

        if ($this->db->trans_status() === FALSE) {
            $status = 'error';
            $result = 'Erreur d\'enregistrement.';
        }
        else {
            $status = 'success';
            $result = 'Enregistrement effectué avec succées.';
        }

        $d = array();
        $d['id'] = $id;
        $d['status'] = $status;
        $d['message'] = $result;

        return $d;
    }

    public function delete(){
        $this->db->delete($this->get_db_table(), array($this->get_db_table_pk() => $this->{$this->get_db_table_pk()}));
        if ($this->db->trans_status() === FALSE) {
            $status = 'error';
            $result = 'Error! ID ['.$this->{$this->get_db_table_pk()}.'] not found';
        }
        else {
            $status = 'success';
            $result = 'Suppression effectuée avec succées.';
        }

        $d = array();
        $d['status'] = $status;
        $d['message'] = $result;

        return $d;
    }

    public function delete_($tble){
        $this->db->delete($tble, array($this->get_db_table_pk() => $this->{$this->get_db_table_pk()}));
        if ($this->db->trans_status() === FALSE) {
            $status = 'error';
            $result = 'Error! ID ['.$this->{$this->get_db_table_pk()}.'] not found';
        }
        else {
            $status = 'success';
            $result = 'Suppression effectuée avec succées.';
        }

        $d = array();
        $d['status'] = $status;
        $d['message'] = $result;

        return $d;
    }
	
    public function get_data(){
        return $this->db->select('*')
                    ->from($this->get_db_table())
                    ->get()
                    ->result();
    }


    public function get_record(){
        $row = $this->db->select('*')
                ->from($this->get_db_table())
                ->where($this->get_db_table_pk(), $this->{$this->get_db_table_pk()})
                ->get()
                ->result();
        $row = reset($row);

        if($row == null)
            $this->{$this->get_db_table_pk()} = null;
        else
            foreach ($row as $param => $value){
                $this->{$param} = $value;
            }
    }

    public function get_record_($tble_name){
        $row = $this->db->select('*')
                ->from($tble_name)
                ->where($this->get_db_table_pk(), $this->{$this->get_db_table_pk()})
                ->get()
                ->result();
        $row = reset($row);

        if($row == null)
            $this->{$this->get_db_table_pk()} = null;
        else
            foreach ($row as $param => $value){
                $this->{$param} = $value;
            }
    }
	
    public function get_record_ien($ien){
        $row = $this->db->select('*')
            ->from($this->get_db_table())
            ->where('ien', $ien)
            ->get()
            ->result();
        $row = reset($row);

        if($row == null)
            $this->{$this->get_db_table_pk()} = null;
        else
            foreach ($row as $param => $value){
                $this->{$param} = $value;
            }
    }

	
    public function get_data_forform_etat(){//baye demba 08/09/2017
        return   		 array(
			'' 		=> 'Choisir' ,
			'1' 	=> 'Actif' ,
			'0' 	=> 'Inactif' ,
		);
    }






}