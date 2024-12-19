Public Class Clientes

    Private Sub Form1_Load(sender As System.Object, e As System.EventArgs) Handles MyBase.Load
        'TODO: This line of code loads data into the 'EncomendasDataSet.Clientes' table. You can move, or remove it, as needed.
        Me.ClientesTableAdapter.Fill(Me.EncomendasDataSet.Clientes)

    End Sub

    Private Sub TextBox1_TextChanged(sender As System.Object, e As System.EventArgs) Handles TextBox1.TextChanged
        FilterClientes()
    End Sub

    Private Sub FilterClientes()
        If String.IsNullOrWhiteSpace(TextBox1.Text) Then
            ClientesBindingSource.Filter = ""
        Else
            ClientesBindingSource.Filter = String.Format("nome LIKE '%{0}%'", TextBox1.Text)
        End If
    End Sub

    Private Sub Button1_Click(sender As System.Object, e As System.EventArgs) Handles Button1.Click
        ' Verifica se algo foi selecionado no ListBox
        If ListBox1.SelectedItem Is Nothing Then
            MessageBox.Show("Selecione um cliente na lista.", "Aviso", MessageBoxButtons.OK, MessageBoxIcon.Warning)
            Return
        End If

        ' Obtém o cliente selecionado no ListBox
        Dim clienteSelecionado As DataRowView = DirectCast(ListBox1.SelectedItem, DataRowView)
        Dim codigoCliente As Integer = Convert.ToInt32(clienteSelecionado("Codigo")) ' Obtém o código do cliente

        ' Aplica o filtro pelo código do cliente
        ClientesBindingSource.Filter = String.Format("codigo = {0}", codigoCliente)

        ' Verifica se o filtro retornou resultados
        If ClientesBindingSource.Count > 0 Then
            ' Obtém os dados do cliente atual
            Dim clienteAtual As DataRowView = DirectCast(ClientesBindingSource.Current, DataRowView)
            Dim nomeCliente As String = clienteAtual("Nome").ToString()
            Dim enderecoCliente As String = clienteAtual("Endereco").ToString()
            Dim telefoneCliente As String = clienteAtual("Telefone").ToString()
            Dim condicoesCliente As String = clienteAtual("CondicoesPagamento").ToString()

            ' Exibe os dados do cliente nos campos
            NameBox.Text = nomeCliente
            AddressBox.Text = enderecoCliente
            PhoneNBox.Text = telefoneCliente
            ConditionsBox.Text = condicoesCliente

            ' Remove o filtro aplicado (opcional, se necessário)
            FilterClientes()
        Else
            MessageBox.Show("Nenhum cliente encontrado com o código fornecido.")
        End If
    End Sub

    Private Sub PictureBox1_Click(sender As System.Object, e As System.EventArgs)

    End Sub
End Class
