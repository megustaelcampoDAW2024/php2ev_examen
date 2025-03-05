<?php

use App\Models\User;
use App\Models\Tarea;
use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Remesa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;

it('verifies that tarea routes exist and show something', function () {
    $routes = [
        ['method' => 'get', 'route' => 'tarea.index'],
        ['method' => 'get', 'route' => 'tarea.create'],
        ['method' => 'post', 'route' => 'tarea.storeRequest'],
        ['method' => 'post', 'route' => 'tarea.store'],
        ['method' => 'get', 'route' => 'tarea.show', 'params' => ['tarea' => 1]],
        ['method' => 'get', 'route' => 'tarea.edit', 'params' => ['tarea' => 1]],
        ['method' => 'put', 'route' => 'tarea.update', 'params' => ['tarea' => 1]],
        ['method' => 'get', 'route' => 'tarea.complete', 'params' => ['tarea' => 1]],
        ['method' => 'put', 'route' => 'tarea.completeUpdate', 'params' => ['tarea' => 1]],
        // ['method' => 'delete', 'route' => 'tarea.destroy', 'params' => ['tarea' => 1]],
    ];

    $operario = User::factory()->create(['rol' => 'O']);

    foreach ($routes as $route) {
        $this->actingAs($operario);
        $params = $route['params'] ?? [];
        $response = $this->{$route['method']}(route($route['route'], $params));
        
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }
        
        $response->assertStatus(200);
    }
});

it('verifies that cliente routes exist and show something', function () {
    $routes = [
        ['method' => 'get', 'route' => 'cliente.index'],
        ['method' => 'get', 'route' => 'cliente.create'],
        ['method' => 'post', 'route' => 'cliente.store'],
        ['method' => 'get', 'route' => 'cliente.show', 'params' => ['cliente' => 1]],
        ['method' => 'get', 'route' => 'cliente.edit', 'params' => ['cliente' => 1]],
        ['method' => 'put', 'route' => 'cliente.update', 'params' => ['cliente' => 1]],
        // ['method' => 'delete', 'route' => 'cliente.destroy', 'params' => ['cliente' => 1]],
    ];

    $admin = User::factory()->create(['rol' => 'A']);

    foreach ($routes as $route) {
        $this->actingAs($admin);
        $params = $route['params'] ?? [];
        $response = $this->{$route['method']}(route($route['route'], $params));
        
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }
        
        $response->assertStatus(200);
    }
});

it('verifies that user routes exist and show something', function () {
    $routes = [
        ['method' => 'get', 'route' => 'user.index'],
        ['method' => 'get', 'route' => 'user.create'],
        ['method' => 'post', 'route' => 'user.store'],
        ['method' => 'get', 'route' => 'user.edit', 'params' => ['user' => 1]],
        ['method' => 'put', 'route' => 'user.update', 'params' => ['user' => 1]],
        // ['method' => 'delete', 'route' => 'user.destroy', 'params' => ['user' => 1]],
    ];

    $admin = User::factory()->create(['rol' => 'A']);

    foreach ($routes as $route) {
        $this->actingAs($admin);
        $params = $route['params'] ?? [];
        $response = $this->{$route['method']}(route($route['route'], $params));
        
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }
        
        $response->assertStatus(200);
    }
});

it('verifies that cuota routes exist and show something', function () {
    $routes = [
        ['method' => 'get', 'route' => 'cuota.index'],
        ['method' => 'get', 'route' => 'cuota.create'],
        ['method' => 'post', 'route' => 'cuota.store'],
        ['method' => 'get', 'route' => 'cuota.edit', 'params' => ['cuota' => 3]],
        ['method' => 'put', 'route' => 'cuota.update', 'params' => ['cuota' => 3]],
        // ['method' => 'delete', 'route' => 'cuota.destroy', 'params' => ['cuota' => 3]],
        ['method' => 'get', 'route' => 'cuota.print', 'params' => ['cuota' => 3]],
        ['method' => 'get', 'route' => 'cuota.paid', 'params' => ['cuota' => 3]],
    ];

    $admin = User::factory()->create(['rol' => 'A']);

    foreach ($routes as $route) {
        $this->actingAs($admin);
        $params = $route['params'] ?? [];
        $response = $this->{$route['method']}(route($route['route'], $params));
        
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }
        
        $response->assertStatus(200);
    }
});

it('verifies that remesa routes exist and show something', function () {
    $routes = [
        ['method' => 'get', 'route' => 'remesa.index'],
        ['method' => 'get', 'route' => 'remesa.create'],
        ['method' => 'post', 'route' => 'remesa.store'],
        ['method' => 'get', 'route' => 'remesa.edit', 'params' => ['remesa' => 1]],
        ['method' => 'put', 'route' => 'remesa.update', 'params' => ['remesa' => 1]],
        // ['method' => 'delete', 'route' => 'remesa.destroy', 'params' => ['remesa' => 1]],
    ];

    $admin = User::factory()->create(['rol' => 'A']);

    foreach ($routes as $route) {
        $this->actingAs($admin);
        $params = $route['params'] ?? [];
        $response = $this->{$route['method']}(route($route['route'], $params));
        
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }
        
        $response->assertStatus(200);
    }
});


it('verifies form submission and processing for creating a task', function () {
    $response = $this->post(route('tarea.store'), [
        'nombre_contacto' => 'John Doe',
        'apellido_contacto' => 'Doe',
        'correo_contacto' => 'john@example.com',
        'telefono_contacto' => '+34644194414',
        'descripcion' => 'Descripción de la tarea',
        'direccion' => 'Calle Falsa 123',
        'poblacion' => 'Ciudad',
        'cod_postal' => '21730',
        'provincia_id' => 21,
        'estado' => 'P',
        'anotaciones_anteriores' => 'Anotaciones anteriores',
        'anotaciones_posteriores' => 'Anotaciones posteriores',
    ]);

    $response->assertStatus(302); // Verifica que redirige después de la creación
    $response->assertSessionHasNoErrors(); // Verifica que no hay errores de validación
});


it('verifies form submission and processing for creating a client', function () {
    $response = $this->post(route('cliente.store'), [
        'nombre' => 'Empresa XYZ',
        'direccion' => 'Calle Falsa 456',
        'poblacion' => 'Ciudad',
        'cod_postal' => '21345',
        'provincia_id' => 21,
        'telefono' => '+34644194415',
        'email' => 'contacto@empresa.xyz',
        'contacto' => 'Jane Doe',
    ]);

    $response->assertStatus(302); // Verifica que redirige después de la creación
    $response->assertSessionHasNoErrors(); // Verifica que no hay errores de validación
});