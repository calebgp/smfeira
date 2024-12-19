<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Initial
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.ClientesButton = New System.Windows.Forms.Button()
        Me.Button1 = New System.Windows.Forms.Button()
        Me.SuspendLayout()
        '
        'ClientesButton
        '
        Me.ClientesButton.Location = New System.Drawing.Point(43, 22)
        Me.ClientesButton.Name = "ClientesButton"
        Me.ClientesButton.Size = New System.Drawing.Size(238, 34)
        Me.ClientesButton.TabIndex = 0
        Me.ClientesButton.Text = "Busca Cliente Por Nome"
        Me.ClientesButton.UseVisualStyleBackColor = True
        '
        'Button1
        '
        Me.Button1.Location = New System.Drawing.Point(43, 73)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(238, 34)
        Me.Button1.TabIndex = 1
        Me.Button1.Text = "Tabela Cliente pelas Condições de Pagamento"
        Me.Button1.UseVisualStyleBackColor = True
        '
        'Initial
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(347, 310)
        Me.Controls.Add(Me.Button1)
        Me.Controls.Add(Me.ClientesButton)
        Me.Name = "Initial"
        Me.Text = "Gestor"
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents ClientesButton As System.Windows.Forms.Button
    Friend WithEvents Button1 As System.Windows.Forms.Button
End Class
