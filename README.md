Esquema global (conceptual) con lo decidido “de momento sí”
Núcleo académico

Group (clase)

1 profesor

muchos alumnos

EvaluationPeriods (Eval 1/2/3 con fechas)

Contenido (flexible)

Topic (tu “tema pequeño”, creado por el profesor para su grupo)

muchas preguntas

reglas de expertise (umbrales por intentos)

puede estar en 1, 2 o 3 evaluaciones

Clasificación curricular y pedagógica (muchos a muchos)

Competency (competencias)

DidacticUnit (unidad didáctica, opcional, organizativa)

Relaciones:

Topic ↔ Competency (M:N)

Topic ↔ DidacticUnit (M:N)

DidacticUnit ↔ Competency (M:N) ✅ (porque has dicho “de momento sí”)

Planificación por evaluación (sin ocultar no realizados)

EvaluationPeriod ↔ Topic (M:N)

define la “lista fija” de topics que aparecen al ver Eval 1, aunque haya 0 intentos

Resultados (lo que ve el profesor/alumno)

Attempt (intento completado):

alumno

topic

evaluación

score (6/10)

completed_at

duration (opcional)

Con esto puedes mostrar, en la card de un alumno + filtro “Eval 1”:

lista fija de topics de Eval 1

por cada topic: último/mejor score, nº intentos del alumno, nivel expertise, “No realizado” si 0

Vista en una sola jerarquía
GROUP
├─ Students
├─ EvaluationPeriods (Eval 1/2/3 con fechas)
│ └─ (asignación) Topics de cada evaluación [M:N]
├─ Topics (propios del grupo)
│ ├─ Questions
│ ├─ ExpertiseRules (umbrales por intentos)
│ ├─ Competencies [M:N]
│ └─ DidacticUnits [M:N]
├─ DidacticUnits [M:N con Topics]
│ └─ Competencies [M:N] ✅
└─ Attempts (Student × Topic × EvaluationPeriod)
└─ score, intentos, fechas, etc.
Notas de consistencia (mínimas)

Si DidacticUnit ↔ Competency existe, puede haber incoherencias con “competencias derivadas de topics”; asúmelo como “declaración” del profesor y más adelante puedes validar o avisar.

Si quieres, el siguiente paso natural es definir qué pantallas existen (admin hub, topics, unidades didácticas, competencias, evaluaciones, alumno card) con sus filtros y navegación.

a, lo que está fijado en el modelo es:

Organization (centro o profesor individual)

Users (teacher, admin, student)

Groups

EvaluationPeriods (Eval 1,2,3)

Topics

Questions

Attempts (intentos de test)

Relaciones principales:

Group → pertenece a Organization

Teacher → tiene Groups

Student → está en Groups

Topic → pertenece a Group

Topic ↔ EvaluationPeriod (puede estar en varias evaluaciones)

Topic ↔ Competency (varias)

Topic ↔ DidacticUnit (varias)

Attempt → student + topic + evaluation

Reglas pedagógicas ya fijadas:

Los topics nunca desaparecen de una evaluación aunque no haya intentos.

El nivel de expertise depende de nº de intentos completados.

Los umbrales se definen al crear el topic.

El alumno ve resultados inmediatamente.

1. Producto y alojamiento

Modelo SaaS: la app y la base de datos viven en tu servidor.

Clientes:

Profesor individual (organización de 1 persona)

Centro educativo (organización con varios profesores)

Todo está aislado por organization.

Roles:

Owner/Admin (gestión de cuentas y grupos)

Teacher (solo ve sus grupos)

Student (solo ve su progreso)

Los administradores técnicos no ven resultados de alumnos por principio de minimización (RGPD).

Modelo pedagógico central 2) Estructura curricular

Cuando se crea un Group (grupo/clase) se puede cargar el currículo del módulo.

Conceptos:

AcademicYear
Group
Competency
Content
Topic
Question
Attempt
Competencias

Se cargan desde plantillas curriculares oficiales.

Están ligadas al curso académico.

El profesor puede modificarlas (responsabilidad docente).

Regla

Un Topic debe estar asociado al menos a una Competency.
Puede tener varias competencias.

3. TeachingUnit

Nombre decidido:

TeachingUnit

Función:

Agrupar topics

Es opcional

Un topic puede pertenecer a 0, 1 o varias TeachingUnits

No gobierna competencias ni evaluaciones.

4. Topics (pieza central del sistema)

Topic representa un tema pequeño de práctica.

Ejemplo:

Bisagras de armario
Regulación de bisagras
Ajuste de herrajes

Cada topic tiene:

preguntas

reglas de expertise

competencias

teaching units (opcional)

evaluaciones

planificación (Gantt)

5. Evaluaciones
   EvaluationPeriod

Ejemplo:

Eval 1
Eval 2
Eval 3

Reglas:

Un topic puede estar en varias evaluaciones.

Los topics nunca desaparecen de la evaluación aunque no se hayan hecho.

6. Sistema de expertise (decisión clave)

El nivel depende del número de intentos completados.

El profesor define los umbrales al crear el topic.

Ejemplo:

Aprendiz → 0 intentos
Intermedio → 3 intentos
Avanzado → 5 intentos
Pro → 8 intentos

En la pantalla final del test el alumno ve:

Resultado: 6/10
Intentos: 3
Nivel actual: Intermedio
Intentos para siguiente nivel: 5
Progreso: █████░░░░

Esto refuerza hábitos de práctica.

7. Intentos de test

Decisión importante:

Solo se guarda:

student
topic
evaluation
score
completed_at

No se guarda:

respuestas del alumno

preguntas falladas

histórico de fallos

8. Pantalla tras terminar un test

Se calcula en el momento:

Se muestran:

score

preguntas incorrectas

respuesta correcta

intentos totales

mejor score

nivel expertise

progreso al siguiente nivel

Pero los fallos no se guardan.

9. Preguntas del test

Decisión:

Siempre las mismas preguntas

No hay banco aleatorio.

10. Planificación del curso (Gantt)

El Gantt es solo planificación docente.

No contiene:

alumnos

resultados

intentos

Solo muestra cuándo se trabaja cada topic.

Campos en Topic:

planned_start_date
planned_end_date

Puede visualizarse:

por curso

por competencia

por teaching unit

11. Disponibilidad del test

Independiente del Gantt.

Opciones:

always_open
manual
follow_planning

Esto permite:

alumnos que avanzan

profesores que controlan apertura

apertura automática si quieren

12. Vista del alumno

Filtro importante:

Topics disponibles ahora

El alumno ve solo:

topics abiertos

Esto simplifica mucho la interfaz.

13. Gantt compartido con alumnos (opcional)

El profesor puede decidir:

Compartir planificación con alumnos

Para que vean:

qué topics vienen

ritmo del curso

posibilidad de avanzar materia

14. Volumen de datos estimado

Ejemplo real:

30 alumnos
30 topics
5 intentos

≈ 4500 intentos

Esto no supone problema de rendimiento.

15. Integración futura con Sisya

Arquitectura implícita:

Sisya → contenidos
Topic-Test → práctica / evaluación

Conexión mediante:

Competencies
Contents
Topics
Estado actual del diseño

El núcleo ya definido es:

Organization
Users
AcademicYear
Group
Competency
TeachingUnit
Topic
Question
EvaluationPeriod
Attempt

---

---

---

---

---

---

---

---

Contexto general

Proyecto: Topic-Test (se integrará en el ecosistema más grande tipo Sisya).
Objetivo: plataforma para crear y realizar tests por topics con analítica, motivación por hábitos (expertise por constancia), planificación docente (Gantt) y uso en centros o por profesor individual.

1. Producto, alojamiento y comercialización
   Modelo de negocio / despliegue

Se venderá como SaaS: tú alojas app + BD en tu servidor.

Se venderá tanto a:

Profesor individual (cuenta personal)

Centro educativo (varios profesores)

En ambos casos el sistema se organiza por Organization (centro o cuenta personal).

Dónde se guardan los datos

En el servidor del SaaS (tu infraestructura). El cliente compra acceso al servicio (incluye hosting, BD, backups, actualizaciones).

2. Roles y permisos (privacidad / legal)
   Roles definidos

Student: ve su contenido y resultados (solo lo suyo).

Teacher: gestiona contenido del/los módulos que imparte y ve solo a sus alumnos/módulos.

Admin (secretaría / informático del centro): gestiona usuarios, grupos, asignaciones, licencias.

Owner: propietario de la Organization (en profesor individual, el propio profesor).

Principio de privacidad

Admin técnico NO debería ver datos académicos (resultados, intentos, progreso) por principio de minimización (RGPD).

Director / orientador / psicólogo: se consideran roles académicos a futuro con alcance limitado, pero no se implementan ahora como base.

3. Estructura escolar real (lo más importante)
   Regla cerrada

Un alumno pertenece a un solo Group (curso/clase) a la vez (no dos cursos simultáneos).

Dentro del Group cursa varios módulos/asignaturas (Instalación, Montaje, Ciencias, Letras, FOL, etc.).

Cada módulo tiene su profesor y su propio currículo/competencias/topics/tests.

Entidades conceptuales clave

Group = curso/clase (ej. “2º FPB Carpintería A”).

Module = asignatura abstracta (Instalación, Montaje, Ciencias, FOL…).

Necesitas una entidad que represente “ese módulo impartido en ese grupo, ese año, por ese profesor”.

Nombre propuesto (más claro que “ModuleRun”): CourseModule / GroupModule / ClassModule.

Concepto: instancia contextual de un Module en un Group.

Qué vive dentro de CourseModule (espacio real de trabajo)

Todo lo pedagógico se cuelga de CourseModule, no del Group:

Competencies

Contents (si se usan)

TeachingUnits

Topics

Questions

EvaluationPeriods

Attempts

Gantt planning

Disponibilidad de tests

4. Caso “pendientes” (módulos arrastrados)
   Caso descrito

Un alumno puede pasar de curso pero arrastrar 1–2 asignaturas pendientes del año anterior.

Decisión cerrada

Se gestionará como A: recuperación en el curso actual:

No se mantiene “vivo” el módulo antiguo.

Se crea (o existe) un CourseModule de recuperación en el año actual y el alumno se matricula ahí con estado de recuperación/pending.

De este modo todo lo que ocurra este año queda en el año actual.

5. Alta del alumno (onboarding) y códigos
   Confusión resuelta

Se distinguió:

Alta a Group (una sola vez)
vs

Alta a Module (módulos del grupo)

Flujo recomendado (coherente con “un alumno = un grupo”)

El alumno se da de alta y entra al Group con un group_code.

Una vez dentro del grupo, ve automáticamente sus módulos del grupo (CourseModules).

Evita que el alumno tenga que meter 5 códigos (uno por módulo).

Códigos por módulo (si se usan) quedarían solo para excepciones (recuperaciones/optativas), pero el flujo normal es 1 alta por grupo.

6. Competencias y currículo oficial
   Precuela/visión: empezar por competencias

Al crear el curso/módulo (CourseModule), se ofrece importar competencias oficiales del módulo (ejemplo que diste: Instalación y montaje, etc.).

Luego el profesor crea contenidos/topics asociados a competencias.

Plantillas curriculares

Se planteó precargar currículos para hacer más “apetecible” el producto.

Se decidió que la plantilla debe ser editable y debe quedar claro:

Es responsabilidad del profesor verificar y ajustar a la normativa vigente.

Consideración importante aportada por ti:

Cambios legales entran por curso académico (no en mitad del curso), pero aun así se mantiene la idea de plantilla editable y responsabilidad docente.

7. Topics: definición y reglas
   Definición

Topic = tema pequeño, muy concreto, con muchas preguntas para ser accesible.

Muchos topics pueden formar una unidad didáctica (pero no quieres rigidez).

Asociaciones obligatorias

Un Topic debe vincularse a al menos una Competency.

Puede vincularse a varias Competencies (decisión posterior: “de momento sí”).

Sharing/export

Topics normalmente son creados por cada profesor para su clase/módulo, pero se consideró fantástico poder exportarlos a otro grupo/módulo del mismo profesor (manual export/import).

Se mencionó que compartir entre profesores podría existir en el futuro, pero no está fijado como base ahora.

8. TeachingUnit (nombre y rol)
   Nombre fijado

TeachingUnit (no “DidacticUnit”).

Estado de decisión

No hay certeza total, pero se decidió un enfoque que no bloquea:

TeachingUnit es opcional y sirve para organización (agrupa topics).

Se recomendó “organización” mejor que “planificación rígida”.

Más adelante se afirmó que TeachingUnit debería poder asociarse:

a varias competencias y que un topic también (se aceptó “de momento sí” como brainstorm).

Nota importante

TeachingUnit no debe ser obligatoria para poder usar la app (para no forzar a todos los profesores a planificar igual).

9. Evaluaciones (periodos) y asignación de topics
   EvaluationPeriod

Eval 1 / Eval 2 / Eval 3 con fechas (definidas al crear el curso/módulo).

Relación con topics (decisión cerrada)

Evaluación tiene una lista fija de topics asignados.

Un topic puede estar en 1, 2 o 3 evaluaciones (no excluyente).

Nunca ocultar topics no realizados:

al ver Eval 1 debe aparecer la lista completa de topics asignados, incluso con 0 intentos.

Vista por alumno + evaluación (requisito UX)

En la card del alumno, al filtrar por Eval 1, se debe ver:

todos los topics asignados a Eval 1

con sus resultados/estado para ese alumno

“No realizado” si 0 intentos

10. Métricas y sistema de alertas (decisiones previas recordadas)

“Hacer un test” = completar y enviar contestando todas las preguntas.

Dos ejes independientes:

Constancia/trabajo: nº de tests completados

Rendimiento: score (media/mejor/último/evolución)

Niveles/medallas de constancia:

POR TOPIC (no global)

Alertas:

En card del alumno: un punto ● si existe cualquier problema.

La alerta se dispara si hay cualquier problema en cualquier test de un topic (no se compensa).

En ficha alumno: se ven todas las alertas y se pueden revisar (check).

11. Expertise (nivel) — decisión pedagógica central
    Decisión cerrada

El nivel de expertise se basa en HÁBITO:

depende del número de intentos completados, no del score.

Argumento: premiar constancia/hábito por encima de capacidad; un alumno que insiste “es un triunfo”.

Configuración por el profesor

Al crear un Topic el profesor define:

4 tramos: “Aprendiz” + 3 niveles (nombres libres)

umbrales de intentos para subir de nivel (por topic)

También se mostrará “lo que falta para el siguiente nivel”.

12. Preguntas y estructura del test
    Preguntas

Se decidió que los tests de un topic usan siempre las mismas preguntas (no banco aleatorio).

Guardado de intentos

Se acordó:

En BD se guarda solo el score final del intento (y metadatos como fecha, alumno, topic, evaluación).

NO se guarda histórico de respuestas ni fallos.

Corrección al finalizar (sin guardar histórico)

Aunque no se guarden fallos, al terminar el test debe mostrarse pantalla resumen con:

score

lista de preguntas incorrectas + respuesta correcta (solo en ese momento)

expertise (nivel actual y progreso al siguiente nivel)

No hace falta mostrar la respuesta incorrecta elegida por el alumno; solo:

pregunta + respuesta correcta.

13. Pantalla post-test (UX) — decisión cerrada

El alumno ve todo al instante:

score

intentos totales en el topic

mejor score

nivel de expertise

lo que falta para siguiente nivel

corrección inmediata (preguntas falladas + respuesta correcta)

Se eligió pantalla B: completa de progreso (más motivadora).

14. Gantt / planificación
    Qué es (decisión cerrada)

Gantt es solo planificación docente orientativa.

NO incluye:

alumnos, resultados, notas, intentos.

Topics se trabajan en periodos de tiempo, no puntualmente.

Datos mínimos

Cada Topic puede tener:

planned_start_date

planned_end_date

Compartir con alumnos

El profesor puede (opcionalmente) compartir la planificación con alumnos.

Objetivo: que sepan el ritmo y puedan avanzar materia si quieren.

“Cada competencia tiene su Gantt”

Se aclaró: no hay “gantt separado”, hay un solo Gantt (fechas del topic) y se puede visualizar filtrado “por competencia” o “por teaching unit”.

15. Disponibilidad de los tests (apertura)
    Decisión cerrada

Debe existir control de disponibilidad, separado de planificación:

El profesor puede elegir si el test:

está abierto siempre

se abre manualmente cuando él quiera

(opcional) seguir la planificación como referencia (si el profesor lo elige)

Importante: Gantt y disponibilidad son conceptualmente independientes; “seguir planificación” es una opción voluntaria del profesor.

Filtro clave para alumnos

“Topics disponibles ahora” para simplificar la experiencia del alumno.

16. Navegación y branding (del bloque anterior del día)

Home real del admin: /admin/topics.

Menú propio para no romper Breeze:

resources/views/components/main-menu.blade.php

reemplazo de @include('layouts.navigation') por <x-main-menu />

Branding assets en public/assets/:

logo.svg, logo-tt.png, start-pic.png

Favicons:

public/favicon.ico modificado

public/favicon2.ico nuevo

En producción los botones JS no funcionaban hasta hacer npm run build.

Mejoras UX pendientes que se mencionaron:

link “Topic: X” arriba en editar preguntas que lleve al listado de topics

reestructuración futura Topic→Test→Question (se debatió, luego el modelo evolucionó hacia módulos/competencias)

17. Decisiones de “cómo se ve” información por evaluación
    Vista evaluación (grupo)

Al pinchar Eval 1: lista fija de topics asignados a Eval 1 (aunque 0 intentos).

Vista evaluación dentro de card alumno

Misma lista fija de topics de Eval 1, pero con métricas SOLO del alumno:

intentos del alumno

media/mejor del alumno (si se quiere)

score último/mejor

nivel expertise

“No realizado” si 0

No interesa ocultar nunca topics no realizados.

18. Nomenclatura que generó confusión y quedó resuelta

“topic vs topics” se aclaró como singular/plural (registro vs colección), pero se decidió usar tu lenguaje: Topic = tema pequeño.

“join_code” renombrado a group_code (más intuitivo).

“ModuleRun” fue rechazado por jerga; concepto renombrado a CourseModule / GroupModule: instancia contextual del módulo en el grupo/año/profesor.

Punto donde quedó el hilo (última posición)

Se estaba consolidando que el espacio real del trabajo docente es CourseModule (módulo impartido en un grupo, por un profesor, en un curso académico).

Se acordó que el alta normal del alumno es al Group mediante group_code, y los módulos se asignan automáticamente; módulos especiales (recuperación) se añaden como excepción.

Si quieres, en el siguiente chat puedes pegar este dossier y arrancamos directamente diseñando:

entidad CourseModule (nombre final) y su navegación (alumno y teacher)

cómo encajan competencias/contenidos por módulo y plantillas

cómo se modela export/import de topics entre módulos/grupos del mismo profesor
