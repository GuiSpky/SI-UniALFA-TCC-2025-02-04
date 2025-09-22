import React, { useRef, useState, useEffect } from 'react';
import { Badge } from '@/components/ui/badge';
import CRUDPage from '@/components/CRUDPage';
import * as XLSX from 'xlsx';
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import toast from 'react-hot-toast';
import { getData } from '@/api';

const UsuariosPage = () => {
  const [escolas, setEscolas] = useState([]);
  const didRun = useRef(false);

  useEffect(() => {
    getEscolas();
  }, []);

  const getEscolas = async () => {
    try {
      var dados = await getData('escolas');
      setEscolas(dados.data || []);
      return dados;
    } catch (err) {
      toast.error('Erro ao carregar escolas!');
      throw err;
    }
  };

  const columns = [
    {
      accessorKey: 'nome',
      header: 'Nome do Usuario',
      cell: ({ row }) => (
        <div className="font-medium">{row.getValue('nome')}</div>
      ),
    },
    {
      accessorKey: 'email',
      header: 'E-mail',
      cell: ({ row }) => (
        <div className="font-mono text-sm">{row.getValue('email')}</div>
      ),
    },
    {
      accessorKey: 'telefone',
      header: 'Telefone',
      cell: ({ row }) => (
        <div className="font-mono text-sm">{row.getValue('telefone')}</div>
      ),
    },
    {
      accessorKey: 'cargo',
      header: 'Cargo',
      cell: ({ row }) => (
        <div className="font-mono text-sm">{row.getValue('cargo')}</div>
      ),
    },
    {
      accessorKey: 'nome_escola',
      header: 'Escola',
      cell: ({ row }) => (
        <div className="font-mono text-sm">{row.getValue('nome_escola')}</div>
      ),
    }
  ];

  const formFields = [
    {
      name: 'nome',
      label: 'Nome do Usuário',
      type: 'text',
      required: true,
      placeholder: 'Digite o nome da Usuário'
    },
    {
      name: 'email',
      label: 'E-mail',
      type: 'email',
      required: true,
      placeholder: 'Digite o e-mail'
    },
    {
      name: 'telefone',
      label: 'Telefone',
      type: 'number',
      required: true,
      placeholder: 'Digite o Telefone'
    },
    {
      name: 'cargo',
      label: 'Cargo',
      type: 'text',
      required: true,
      placeholder: 'Digite o Cargo'
    },
    {
      name: 'id_escola',
      label: 'Escola do Usuário',
      type: 'select',
      required: true,
      placeholder: 'Selecione a escola',
      options: escolas,
      labelField: 'nome',
      valueField: 'id'
    }
  ];

  const handleExportExcel = (data) => {
    const worksheet = XLSX.utils.json_to_sheet(data.map(item => ({
      'Usuario': item.nome,
      'Email': item.email,
      'Telefone': item.telefone,
      'Cargo': item.cargo,
      'Escola': item.escola
    })));

    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, 'Usuarios');
    XLSX.writeFile(workbook, 'usuarios.xlsx');
  };

  const handleExportPDF = (data) => {
    const doc = new jsPDF();

    doc.setFontSize(18);
    doc.text('Lista de Usuários', 14, 22);

    const tableColumn = ['Nome', 'Email', 'Telefone', 'Cargo', 'Escola'];
    const tableRows = data.map(item => [
      item.nome,
      item.email,
      item.telefone,
      item.cargo,
      item.escola,
    ]);

    doc.autoTable({
      head: [tableColumn],
      body: tableRows,
      startY: 30,
    });

    doc.save('usuarios.pdf');
  };

  return (
    <CRUDPage
      title="Usuários"
      entityType="usuarios"
      columns={columns}
      formFields={formFields}
      newButtonLabel="Novo Usuário"
      searchPlaceholder="Buscar Usuários..."
      onExportExcel={handleExportExcel}
      onExportPDF={handleExportPDF}
    />
  );
};

export default UsuariosPage;

