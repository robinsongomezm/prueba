<?php

class MeserosController extends AppController 
{

	//Aqui tengo que llamar a los helpers siempre para que me ayude
	public $helpers = array('Html', 'Form', 'Time');
	public $components = array('Session');

	//Aqui llamo a las funciones
	public function index()
		{

			$this->set('meseros', $this->Mesero->find('all'));
		}

	public function ver($id = null) 
		{
		
			if(!$id)
			{
				throw new NotFoundException("Datos invalidos");	
			}

			$mesero=$this->Mesero->findById($id);

			if(!$mesero)
			{
				throw new NotFoundException("El mesero no existe");
			}

			$this->set('mesero', $mesero);
		}

	public function nuevo()
	{
		if ($this->request->is('post'))
		{
			$this->Mesero->create();
			if ($this->Mesero->save($this->request->data)) 
			{
				$this->Session->setFlash('El Mesero ha sido creado', 'default', array('class'=>'success'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash('No se pudo crear el mesero');	
		}

	}

	public function editar($id = null)
	{
		if(!$id)
			{
				throw new NotFoundException("Datos inválidos");	
			}

		$mesero = $this->Mesero->findById($id);
		if(!$mesero)
			{
				throw new NotFoundException("El Mesero no ha sido encontrado");	
			}

		if($this->request->is('post', 'put'))
		{
			$this->Mesero->id = $id;

			if($this->Mesero->save($this->request->data))
			{
				$this->Session->setFlash('El mesero ha sido modificado', $element = 'default', $params = array('class' => 'success'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash('El registro no puedo ser modificado');
		}
		if(!$this->request->data)
			{
				$this->request->data= $mesero;
			}	
	}

	public function eliminar($id)
	{
		if($this->request->is('get'))
		{
			throw new MethodNotAllowedException('INCORRECTO');	
		}
		if($this->Mesero->delete($id))
		{
			$this->Session->setFlash('El mesero ha sido eliminado', $element='default', $params=array('class'=>'success'));
			return $this->redirect(array('action'=>'index'));
		}
	}
}
