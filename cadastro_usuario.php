<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form action="inserir_dados_clientes.php" method="post">
        <input type="text" name="nome" placeholder="Nome" required><br>
        <input type="text" name="sobrenome" placeholder="Sobrenome" required><br>
        <input type="text" name="cpf" placeholder="CPF" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>

        <label for="genero">Selecione seu gênero:</label>
        <select name="genero" id="genero" required>
            <option value="homem">Homem</option>
            <option value="mulher">Mulher</option>
            <option value="transmasculino">Transmasculino</option>
            <option value="transfeminino">Transfeminino</option>
            <option value="naobinario">Não-binário</option>
            <option value="agenero">Agênero</option>
            <option value="bigenero">Bi-gênero</option>
            <option value="pangenero">Pan-gênero</option>
            <option value="demiboy">Demiboy</option>
            <option value="demigirl">Demigirl</option>
            <option value="genderfluid">Genderfluid</option>
            <option value="genderqueer">Genderqueer</option>
            <option value="androgino">Andrógino</option>
            <option value="neutrois">Neutrois</option>
            <option value="two-spirit">Two-Spirit</option>
            <option value="intergenero">Intergênero</option>
            <option value="poligenero">Poligênero</option>
            <option value="maverique">Maverique</option>
            <option value="omnigenero">Omnigênero</option>
            <option value="x-gender">X-Gender</option>
            <option value="genderquestioning">Questionando</option>
            <option value="gendernonconforming">Não-conforme de gênero</option>
            <option value="gendervariant">Variante de gênero</option>
            <option value="androgyne">Andrógino (variação)</option>
            <option value="demiflux">Demiflux</option>
            <option value="autigenero">Autigênero</option>
            <option value="ceterogenero">Ceterogênero</option>
            <option value="greygender">Grey-gênero</option>
            <option value="neutro-gênero">Neutro-gênero</option>
            <option value="floragenero">Flora-gênero</option>
            <option value="libragenero">Libra-gênero</option>
            <option value="novigenero">Novigênero</option>
            <option value="mirigenero">Miri-gênero</option>
            <option value="quarternario">Quaternário</option>
            <option value="omnisexual-gender">Omnisexual-gênero</option>
            <option value="androsexual-gender">Androsexual-gênero</option>
            <option value="gynesexual-gender">Gynessexual-gênero</option>
            <option value="skoliosexual-gender">Skoliosexual-gênero</option>
            <option value="demigender">Demigênero</option>
            <option value="subgender">Subgênero</option>
            <option value="novogender">Novo-gênero</option>
            <option value="transgenero">Transgênero</option>
            <option value="cisgenero">Cisgênero</option>
            <option value="androqueer">Androqueer</option>
            <option value="gyniqueer">Gyniqueer</option>
            <option value="apogenero">Apogênero</option>
            <option value="ambigenero">Ambigênero</option>
            <option value="exogenero">Exogênero</option>
            <option value="outra">Outra</option>
        </select><br>

        <input type="date" name="nascimento" required><br>
        <input type="tel" name="telefone" placeholder="(11) 91234-5678" pattern="\(\d{2}\) \d{4,5}-\d{4}" required><br>
        <input type="text" name="logradouro" placeholder="Logadouro" required><br>
        <input type="number" name="numero" placeholder="Número" required><br>
        <input type="text" name="complemento" placeholder="Complemento"><br>
        <input type="text" name="bairro" placeholder="Bairro" required><br>
        <input type="text" name="cidade" placeholder="Cidade" required><br>
        <input type="text" name="estado" placeholder="Estado" required><br>
        <input type="text" name="cep" placeholder="CEP" required><br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>

