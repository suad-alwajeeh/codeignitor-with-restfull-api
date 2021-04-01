<?php 
namespace App\Controllers;
use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class EmployeeCrud extends Controller
{
    // show employees list
    public function index(){
        $EmployeeModel = new EmployeeModel();
        $data['employees'] = $EmployeeModel->orderBy('id', 'DESC')->findAll();
        return view('employee_view', $data);
    }

    // add employee form
    public function create(){
        return view('add_employee');
    }
 
    // insert data
    public function store() {
        $EmployeeModel = new EmployeeModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $EmployeeModel->insert($data);
        return $this->response->redirect(site_url('/employees-list'));
    }

    // show single employee
    public function singleemployee($id = null){
        $EmployeeModel = new EmployeeModel();
        $data['employee_obj'] = $EmployeeModel->where('id', $id)->first();
        return view('edit_view', $data);
    }

    // update employee data
    public function update(){
        $EmployeeModel = new EmployeeModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $EmployeeModel->update($id, $data);
        return $this->response->redirect(site_url('/employees-list'));
    }
 
    // delete employee
    public function delete($id = null){
        $EmployeeModel = new EmployeeModel();
        $data['employees'] = $EmployeeModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/employees-list'));
    }    
}