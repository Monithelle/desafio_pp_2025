<?php

class Database
{

    private $host = "localhost";
    private $db_name = "projetos";
    private $username = "root";
    private $password = "admin";

    protected $conexao;

    public function __construct()
    {
        try {
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}

class Crud extends Database
{

    public function create($params)
    {
        $query = "INSERT INTO eventos (tipo, nome, descricao, endereco, link_endereco, datahora_inicio, preco) VALUES (:tipo, :nome, :descricao, :endereco, :link_endereco, :datahora_inicio, :preco)";
        $stmt = $this->conexao->prepare($query);

        return $stmt->execute([
            'tipo' => $params['tipo'],
            'nome' => $params['nome'],
            'descricao' => $params['descricao'],
            'endereco' => $params['endereco'],
            'link_endereco' => $params['link_endereco'],
            'datahora_inicio' => $params['datahora_inicio'],
            'preco' => $params['preco']
        ]);
    }


    public function read($filtros)
    {

        $query = "SELECT * FROM eventos WHERE 1=1";
        $params = [];

        if (!empty($filtros['tipo'])) {
            $query .= " AND tipo = :tipo";
            $params[':tipo'] = $filtros['tipo'];
        }
        if (!empty($filtros['nome'])) {
            $query .= " AND nome LIKE :nome";
            $params[':nome'] = "%{$filtros['nome']}%";
        }
        if (!empty($filtros['endereco'])) {
            $query .= " AND endereco LIKE :endereco";
            $params[':endereco'] = "%{$filtros['endereco']}%";
        }
        if (!empty($filtros['data_inicio'])) {
            $data_inicio = DateTime::createFromFormat('Y-m-d', $filtros['data_inicio']);
            if ($data_inicio) {
                $params[':data_inicio'] = $data_inicio->format('Y-m-d H:i:s');
                $query .= " AND datahora_inicio >= :data_inicio";
            }
        }

        if (!empty($filtros['data_fim'])) {
            $data_fim = DateTime::createFromFormat('Y-m-d', $filtros['data_fim']);
            if ($data_fim) {
                $params[':data_fim'] = $data_fim->format('Y-m-d H:i:s');
                $query .= " AND datahora_inicio <= :data_fim";
            }
        }
        if (!empty($filtros['preco_min'])) {
            $query .= " AND preco >= :preco_min";
            $params[':preco_min'] = $filtros['preco_min'];
        }
        if (!empty($filtros['preco_max'])) {
            $query .= " AND preco <= :preco_max";
            $params[':preco_max'] = $filtros['preco_max'];
        }

        $stmt = $this->conexao->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($params)
    {
        $query = "UPDATE eventos SET tipo = :tipo, nome = :nome, descricao = :descricao, endereco = :endereco, link_endereco = :link_endereco, datahora_inicio = :datahora_inicio, preco = :preco WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        return $stmt->execute([
            'id' => $params['id'],
            'tipo' => $params['tipo'],
            'nome' => $params['nome'],
            'descricao' => $params['descricao'],
            'endereco' => $params['endereco'],
            'link_endereco' => $params['link_endereco'],
            'datahora_inicio' => $params['datahora_inicio'],
            'preco' => $params['preco']
        ]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM eventos WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        return $stmt->execute(['id' => $id]);
    }
    public function getevento($id)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM eventos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarevento($id, $tipo, $nome, $descricao, $endereco, $link_endereco, $datahora_inicio, $preco)
    {
        $stmt = $this->conexao->prepare("UPDATE eventos SET tipo = ?, nome = ?, descricao = ?, endereco = ?, link_endereco = ?, datahora_inicio = ?, preco = ? WHERE id = ?");
        return $stmt->execute([$tipo, $nome, $descricao, $endereco, $link_endereco, $datahora_inicio, $preco, $id]);
    }

    public function excluirevento($id)
    {
        $stmt = $this->conexao->prepare("DELETE FROM eventos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}