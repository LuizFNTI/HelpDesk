<?php
include 'conexao.php';

    class Usuario {
        private $matricula;
        private $nome;
        private $telefone;
        private $email;
        private $departamento;
        private $senha;
        private $nivel
        private $ativo;

        public function setMatricula($matricula) {
            $this->$matricula = $matricula;
        }
        public function getMatricula() {
            return $this->matricula;
        }
        public function setNome($nome) {
            $this->$nome = $nome;
        }
        public function getNome() {
            return $this->nome;
        }
        public function setTelefone($telefone) {
            $this->$telefone = $telefone;
        }
        public function getTelefone() {
            return $this->telefone;
        }
        public function setEmail($email) {
            $this->$email = $email;
        }
        public function getEmail() {
            return $this->email;
        }
        public function setDepartamento($departamento) {
            $this->$departamento = $departamento;
        }
        public function getDepartamento() {
            return $this->departamento;
        }
        public function setSenha($senha) {
            $this->$senha = $senha;
        }
        public function getSenha() {
            return $this->senha;
        }
        public function setNivel($nivel) {
            $this->$nivel = $nivel;
        }
        public function getNivel() {
            return $this->nivel;
        }
        public function setAtivo($ativo) {
            $this->$ativo = $ativo;
        }
        public function getAtivo() {
            return $this->ativo;
        }

        public function buscarDados() {
            
        }
    }



?>