<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SiswaModel;

class SiswaController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new SiswaModel();
        $data['siswa'] = $model->orderBy('siswa_id', 'ASC')->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new SiswaModel();
        $data = $model->where('siswa_id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No siswa found');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new SiswaModel();
        $data = [
            'nisn'  => $this->request->getVar('nisn'),
            'nama' => $this->request->getVar('nama'),
            'jurusan' => $this->request->getVar('jurusan'),
        ];
        $model->insert($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Siswa created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new SiswaModel();
        if ($id === null) {
            $id = $this->request->getVar('siswa_id');
        }

        $data = [
            'nisn'  => $this->request->getVar('nisn'),
            'nama' => $this->request->getVar('nama'),
            'jurusan' => $this->request->getVar('jurusan'),
        ];
        $model->update($id,$data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Siswa updated successfully'
          ]
      ];
      return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new SiswaModel();
        $data = $model->where('siswa_id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Siswa successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No siswa found');
        }
    }
}
