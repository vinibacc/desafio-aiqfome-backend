<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Desafio aiqfome",
 *     description="Documentação da API de clientes e favoritos",
 *     @OA\Contact(
 *         email="exemple@exemple.com"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearer_token",
 *     type="http",
 *     scheme="bearer"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor local"
 * )
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="Endpoints de autenticação"
 * )
 *
 * @OA\Tag(
 *     name="Clients",
 *     description="Gerenciamento de clientes"
 * )
 *
 * @OA\Tag(
 *     name="Products",
 *     description="Gerenciamento de produtos"
 * )
 */
class SwaggerDocs
{
    // Só serve para anotações globais
}
