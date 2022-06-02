<?php

namespace App\Controllers;

class Cerdos extends BaseController
{
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
		$this->request = \Config\Services::request();
    }

    public function index()
    {
        $data = $this->getData();

        return view('elementos/header-menu').view('pig/cerdos', $data).view('elementos/footer');
    }

    public function create()
    {
        $data = $this->request->getPost();                        
     
        if($data['raza'] != '' && $data['peso'] != ''){
            //Animal
            $animal = [
                'raza' => strtolower($data['raza']),
                'fecha_nacimiento' => $data['fecha-nacimiento'],
                'estado' => strtolower($data['estado']),
                'peso' => $data['peso'],
            ];            
            $builderA = $this->db->table('animal');
            $builderA->insert($animal);                      
            $id = $this->db->insertID();

            //HistorialPeso
            $peso = [
                'peso' => $data['peso'],
                'fecha' => date("Y-m-d"),
                'id_animal' => $id,
            ];
            $builderP = $this->db->table('historial_peso');
            $builderP->insert($peso);

            //Lote
            $builderL = $this->db->table('lote');
            //$lote = $builderL->where('nombre',$data['lote'])->get()->getResultArray();
            //$lote = $this->db->table('lote')->where('nombre',$data['lote'])->get(1)->getResultArray();
            //$sql = "SELECT * FROM lote WHERE nombre = ?";
            //$idLote = $this->db->query($sql, [strtolower($data['lote'])])->get(1)->getResultArray();            
            //print_r(json_encode($lote));
            //LoteAnimal
            $loteAnimal = [
                'id_lote' => $data['lote'],
                'id_animal' => $id,
            ];
            $builderLA = $this->db->table('lote_animal');
            $builderLA->insert($loteAnimal);

            print_r('ok');
            return;
        } else {
            print_r('error');
        }
    }

    public function delete($id)
    {
        //Tabla historialPeso
        $sql = "DELETE FROM historial_peso WHERE id_animal = ?";
        $query = $this->db->query($sql, [$id]);     
        //Tabla loteAnimal
        $sql = "DELETE FROM lote_animal WHERE id_animal = ?";
        $query = $this->db->query($sql, [$id]);  
        //Tabla animal
        $sql = "DELETE FROM animal WHERE  id = ?";
        $query = $this->db->query($sql, [$id]);           

        print_r('ok');
        return redirect()->to('/Cerdos');
    }

    public function getData(){
        //consulta de lotes
        $lotes = $query = $this->db->table('lote')->get()->getResultArray();     
        //consulta de animales
        //$animales = $query = $this->db->table('animal')->get()->getResultArray();          
        //Dastos completos del animal
        $sql = "SELECT a.id, a.raza, a.fecha_nacimiento, a.estado, a.peso, l.nombre as lote  FROM animal AS a, lote_animal AS la, lote AS l WHERE  a.id = la.id_animal AND la.id_lote = l.id";
        $animales = $this->db->query($sql)->getResultArray();
        //$lote = $this->db->table('lote')->where('id',$data['lote'])->get(1)->getResultArray();
        //$datosAnimales = $animales;        
        
        //data
        $data = array(
            "animales" => $animales, 
            "lotes" => $lotes
            //"datosAnimales" => $datosAnimales
        );

        return $data;
    }
}