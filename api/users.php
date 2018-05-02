<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function () use ($app) {

        $app->get('/users', function (Request $request, Response $response, array $args) {

            $users= $this->db->query("SELECT * FROM users");

            $data = $users->fetchAll();

            $response->getBody()->write(json_encode($data));

            return $response->withHeader(
                'Content-Type',
                'application/json'
            );

        });

        $app->get('/users/search/{name}', function (Request $request, Response $response, array $args) {

            $name = strip_tags($args['name']);

            $user = $this->db->prepare("SELECT * FROM users WHERE name = :name");
            $user->execute([':name' => $name]);

            $data = $user->fetch();

            $response->getBody()->write(json_encode($data));

            return $response->withHeader(
                'Content-Type',
                'application/json'
            );

        });

        $app->post('/users', function (Request $request, Response $response, array $args) {

            $data = $request->getParsedBody();

            $keys = array_keys($data);
            $values = array_values($data);

            $keyString = '';
            $valueString = '';

            for ($i = 0; $i < count($data); $i++) {
                $coma = '';

                if ($i != 0) $coma = ',';

                $keyString .= $coma . '`'. $keys[$i] .'`';
                $valueString .= $coma . "'". $values[$i] ."'";
            }

            $query = "INSERT INTO users($keyString) VALUES($valueString)";

            try {

                $this->db->query($query);
                $response->getBody()->write(true);

            } catch(PDOException $ex) {

                $response->getBody()->write(false);

            }

            return $response->withHeader(
                'Content-Type',
                'application/json'
            );
        });

    $app->put('/users/{id}', function (Request $request, Response $response, array $args) {

        $id = (int) $args['id'];

        $data = $request->getParsedBody();

        $keys = array_keys($data);
        $values = array_values($data);

        $set = '';

        for ($i = 0; $i < count($data); $i++) {
            $coma = '';

            if ($i != 0) $coma = ',';

            $set .= $coma .' '. $keys[$i] .' = "'. $values[$i] .'"';
        }

        $query = "UPDATE users SET $set  WHERE id = :id";

        try {

            $result = $this->db->prepare($query);
            $result->execute([':id' => $id]);

            $response->getBody()->write(true);

        } catch(PDOException $ex) {

            $response->getBody()->write(false);

        }

        return $response->withHeader(
            'Content-Type',
            'application/json'
        );

    });

    $app->delete('/users/{id}', function (Request $request, Response $response, array $args) {
       $id = (int) $args['id'];

       try {
           $result = $this->db->prepare("DELETE FROM users WHERE id = :id");
           $result->execute([':id' => $id]);
       } catch(PDOException $e) {
           $e->getMessage();
       }

       $response->getBody()->write(true);

       return $response->withHeader(
           'Content-Type',
           'application/json'
       );
    });

});