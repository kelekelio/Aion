<?php
namespace PowerBook;

/**
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
class ItemRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param  int $id
     * @return Item
     */
    public function find($id)
    {
        $statement = $this->connection->prepare('SELECT mesh, equipment_slots FROM client_items WHERE id = :id LIMIT 1');
        $statement->bindValue('id', $id);
        $statement->execute();

        if (false === $item = $statement->fetch()) {
            return null;
        }

        return new Item(strtolower($item['mesh']), $item['equipment_slots']);
    }
}
