document.addEventListener("DOMContentLoaded", () => {
    const list = document.getElementById("answers-list");
    const deleteContainer = document.getElementById("answers-delete-container");

    if (!list || !deleteContainer) return;

    let newAnswerIndex = 0;

    function addNewAnswer() {
        const row = document.createElement("div");
        row.className = "answer-row flex items-center gap-3";
        row.dataset.newIndex = String(newAnswerIndex);

        row.innerHTML = `
      <input type="radio" name="correct" value="n:${newAnswerIndex}">
      <input name="answers_new[${newAnswerIndex}][text]" class="border rounded w-full p-2" placeholder="Nueva respuesta">
      <button type="button" class="underline text-sm text-red-600"
              data-action="delete-new" data-new-index="${newAnswerIndex}">
        Eliminar
      </button>
    `;

        list.appendChild(row);
        newAnswerIndex++;
    }

    function markDeleteExisting(id) {
        const exists = deleteContainer.querySelector(
            `input[name="answers_delete[]"][value="${id}"]`,
        );

        if (!exists) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "answers_delete[]";
            input.value = String(id);
            deleteContainer.appendChild(input);
        }

        const row = list.querySelector(`.answer-row[data-existing-id="${id}"]`);
        if (row) row.style.display = "none";
    }

    function removeNewAnswer(idx) {
        const row = list.querySelector(`.answer-row[data-new-index="${idx}"]`);
        if (row) row.remove();
    }

    document.addEventListener("click", (e) => {
        const btn = e.target.closest("button[data-action]");
        if (!btn) return;

        const action = btn.dataset.action;

        if (action === "add-answer") addNewAnswer();

        if (action === "delete-existing") {
            const id = btn.dataset.answerId;
            if (id) markDeleteExisting(id);
        }

        if (action === "delete-new") {
            const idx = btn.dataset.newIndex;
            if (idx) removeNewAnswer(idx);
        }
    });
});
