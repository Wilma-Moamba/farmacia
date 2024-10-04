<!-- AINDA NAO PROGRAMADO E ORGANIZADO -->
<h1>Lista de Medicamentos</h1>
<a href="/medicamentos/criar">Adicionar Medicamento</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($medicines as $medicine): ?>
        <tr>
            <td><?= $medicine->id ?></td>
            <td><?= $medicine->name ?></td>
            <td><?= $medicine->quantity ?></td>
            <td><?= $medicine->price ?></td>
            <td>
                <a href="/medicamentos/<?= $medicine->id ?>">Detalhes</a> |
                <a href="/medicamentos/<?= $medicine->id ?>/editar">Editar</a> |
                <a href="/medicamentos/<?= $medicine->id ?>/deletar" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
