<?php 
include("conexao.php");

Class Funcionario{

    public $nome;
    public $funcao;
    public $lanche;
    public $horista;
    public $conn;

    function __construct()
    {
        $this->conn = new Conexao();
        $this->conn = $this->conn->conexaoPDO();
    }

    function cadastrar($dados, $campos, $tabela){
        $query = "insert into $tabela ( $dados ) values ( $campos )";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

        return "Usuario cadastrado com sucesso.";
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
    }

    function atualizar($dados, $tabela, $where){
        $query = "UPDATE $tabela SET $dados WHERE $where";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

        return "Usuario atualizado com sucesso.";
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
    }

    function excluir($tabela, $where){
        $query = "DELETE FROM $tabela $where";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

        return "Usuario excluido com sucesso.";
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
    }

    function CarregarFuncionarios($order, $where = 'WHERE 1 = 1'){
        $query = "SELECT RECNO as id, POU_NOME as nome, POU_SAIDA as saida, POU_RETORNO as retorno, POU_SETOR as setor, POU_PRESENTE as presenca, POU_HORISTA as horista 
                  FROM pou_funcionarios $where ORDER BY $order ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO:: FETCH_ASSOC);

        return $arr;
    }

    function contagemSetores(){
        $query = "SELECT COUNT()* ";
    }
}


?>