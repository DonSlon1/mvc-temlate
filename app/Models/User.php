<?php
    namespace App\Models;

    use App\Core\Model;

    class User extends Model {
        // Fetch a user by ID
        public static function find($id) {
            $instance = new self();
            $queryBuilder = $instance->db->createQueryBuilder();
            $queryBuilder
                ->select('*')
                ->from('users')
                ->where('id = :id')
                ->setParameter('id', $id);
            return $queryBuilder->execute()->fetchAssociative();
        }

        // Fetch all users
        public static function all() {
            $instance = new self();
            $queryBuilder = $instance->db->createQueryBuilder();
            $queryBuilder
                ->select('*')
                ->from('users');
            return $queryBuilder->execute()->fetchAllAssociative();
        }

        // Create a new user
        public static function create($data) {
            $instance = new self();
            $queryBuilder = $instance->db->createQueryBuilder();
            return $queryBuilder
                ->insert('users')
                ->values([
                    'name' => ':name',
                    'email' => ':email',
                    'password' => ':password'
                ])
                ->setParameters([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => password_hash($data['password'], PASSWORD_DEFAULT)
                ])
                ->execute();
        }

        // Update an existing user
        public static function update($id, $data) {
            $instance = new self();
            $queryBuilder = $instance->db->createQueryBuilder();
            return $queryBuilder
                ->update('users')
                ->set('name', ':name')
                ->set('email', ':email')
                ->set('password', ':password')
                ->where('id = :id')
                ->setParameters([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    'id' => $id
                ])
                ->execute();
        }

        // Delete a user
        public static function delete($id) {
            $instance = new self();
            $queryBuilder = $instance->db->createQueryBuilder();
            return $queryBuilder
                ->delete('users')
                ->where('id = :id')
                ->setParameter('id', $id)
                ->execute();
        }
    }
