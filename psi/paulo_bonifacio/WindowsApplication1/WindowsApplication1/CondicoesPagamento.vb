Imports System.Windows.Forms

Public Class CondicoesPagamento

    Private Sub OK_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles OK_Button.Click
        Me.DialogResult = System.Windows.Forms.DialogResult.OK
        Me.Close()
    End Sub

    Private Sub Cancel_Button_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Cancel_Button.Click
        Me.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.Close()
    End Sub

    Private Sub Dialog1_Load(sender As System.Object, e As System.EventArgs) Handles MyBase.Load
        'TODO: This line of code loads data into the 'EncomendasDataSet.CondicoesPagamento' table. You can move, or remove it, as needed.
        Me.CondicoesPagamentoTableAdapter.Fill(Me.EncomendasDataSet.CondicoesPagamento)
        'TODO: This line of code loads data into the 'EncomendasDataSet.Clientes' table. You can move, or remove it, as needed.
        Me.ClientesTableAdapter.Fill(Me.EncomendasDataSet.Clientes)

    End Sub

    Private Sub ListBox1_SelectedIndexChanged(sender As System.Object, e As System.EventArgs) Handles ListBox1.SelectedIndexChanged
        ClientesBindingSource.Filter = String.Format("CondicoesPagamento LIKE '%{0}%'", ListBox1.Text)
    End Sub
End Class
