<?php
/**
 * Documentos institucionales descargables (PDF).
 *
 * Para agregar o cambiar un documento: editar este listado y subir el PDF a
 * assets/documents/ con el nombre indicado en 'file'. No hace falta tocar la plantilla.
 * Si el PDF todavía no existe en el servidor, la tarjeta muestra "Documento en preparación".
 */
defined( 'ABSPATH' ) || exit;

function cspm_document_groups(): array {
    return [
        [
            'id'    => 'marco-normativo',
            'title' => 'Marco normativo e institucional',
            'intro' => '',
            'items' => [
                [
                    'id'    => 'alcances-del-titulo',
                    'title' => 'Alcances del título',
                    'desc'  => 'Resolución (M.C. y E.) N.º 2.473/84: incumbencias profesionales de los títulos de Psicopedagogo/a, Licenciado/a y Profesor/a en Psicopedagogía.',
                    'file'  => 'alcances-del-titulo-res-2473-84.pdf',
                ],
                [
                    'id'    => 'estatuto',
                    'title' => 'Estatuto',
                    'desc'  => 'Norma organizativa del Colegio: derechos y deberes de los colegiados, órganos de gobierno, régimen disciplinario y económico. Su lectura es recomendada para participar en la asamblea.',
                    'file'  => 'estatuto.pdf',
                ],
                [
                    'id'    => 'ley-i-n-131',
                    'title' => 'Ley I – N.º 131',
                    'desc'  => 'Ley de creación del Colegio (antes Ley 4071): ejercicio de la profesión, órganos, régimen disciplinario y matrícula.',
                    'file'  => 'ley-i-n-131.pdf',
                ],
                [
                    'id'    => 'codigo-de-etica',
                    'title' => 'Código de Ética',
                    'desc'  => 'Código de Ética del Colegio de Psicopedagogos de Misiones.',
                    'file'  => 'codigo-de-etica.pdf',
                ],
            ],
        ],
        [
            'id'    => 'buenas-practicas',
            'title' => 'Buenas prácticas profesionales',
            'intro' => 'Las buenas prácticas profesionales se construyen con decisiones éticas, con responsabilidad y también con herramientas claras. Desde el Colegio te dejamos documentos de uso habitual en el ámbito clínico.',
            'quote' => 'Escribir, registrar y comunicar no es burocracia: es cuidar.',
            // Imagen del bloque (assets/images/). Quitar esta clave para mostrar el grupo sin imagen.
            'image' => [
                'file'    => 'buenas-practicas.jpg',
                'width'   => 900,
                'height'  => 562,
                'alt'     => 'Tres profesionales conversan alrededor de una mesa de trabajo con carpetas, en un consultorio psicopedagógico.',
                'caption' => 'Imagen ilustrativa.',
            ],
            'items' => [
                [
                    'id'    => 'modelo-plan-de-tratamiento',
                    'title' => 'Modelo de plan de tratamiento',
                    'desc'  => 'Hoja de ruta que organiza los objetivos, las estrategias y el recorrido de la intervención en el ámbito clínico.',
                    'file'  => 'modelo-plan-de-tratamiento.pdf',
                ],
                [
                    'id'    => 'consentimiento-informado-2026',
                    'title' => 'Consentimiento informado 2026',
                    'desc'  => 'Acuerdo escrito para el proceso de evaluación diagnóstica y/o tratamiento: explica cómo será el trabajo y da claridad y confianza desde el inicio.',
                    'file'  => 'consentimiento-informado-2026.pdf',
                ],
                [
                    'id'    => 'consentimiento-informado',
                    'title' => 'Consentimiento informado (modelo general)',
                    'desc'  => 'Modelo de consentimiento para intervenciones psicopedagógicas: objetivos, beneficios, alternativas, riesgos previsibles y compromisos de la familia y del profesional.',
                    'file'  => 'consentimiento-informado.pdf',
                ],
            ],
        ],
    ];
}
