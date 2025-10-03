<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\DocumentoTipo;

class DocumentoTipoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_documento_tipo_publico(): void
    {
        $doc = new DocumentoTipo();
        $doc->nombre = 'público';
        $doc->save();

        $this->assertDatabaseHas('documento_tipos', [
            'id'     => $doc->id,
            'nombre' => 'público',
        ]);
    }

    /** @test */
    public function crea_documento_tipo_privado(): void
    {
        $doc = new DocumentoTipo();
        $doc->nombre = 'privado';
        $doc->save();

        $this->assertDatabaseHas('documento_tipos', [
            'id'     => $doc->id,
            'nombre' => 'privado',
        ]);
    }

    /** @test */
    public function crea_documento_tipo_acta_notarial(): void
    {
        $doc = new DocumentoTipo();
        $doc->nombre = 'acta notarial';
        $doc->save();

        $this->assertDatabaseHas('documento_tipos', [
            'id'     => $doc->id,
            'nombre' => 'acta notarial',
        ]);
    }

    /** @test */
    public function actualiza_tipo_de_documento(): void
    {
        $doc = new DocumentoTipo();
        $doc->nombre = 'público';
        $doc->save();

        $doc->nombre = 'privado';
        $doc->save();

        $this->assertDatabaseHas('documento_tipos', [
            'id'     => $doc->id,
            'nombre' => 'privado',
        ]);
    }

    /** @test */
    public function elimina_un_tipo_de_documento(): void
    {
        $doc = new DocumentoTipo();
        $doc->nombre = 'acta notarial';
        $doc->save();

        $doc->delete();

        $this->assertSoftDeleted('documento_tipos', [
            'id' => $doc->id,
        ]);
    }
}
