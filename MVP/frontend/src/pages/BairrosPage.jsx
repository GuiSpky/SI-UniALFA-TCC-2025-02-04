import React, { useEffect, useRef, useState } from 'react';
import CRUDPage from '@/components/CRUDPage';
import 'jspdf-autotable';
import { getData } from '@/api';

const BairrosPage = () => {
  const [cidades, setCidades] = useState([]);
  const didRun = useRef(false);
  useEffect(() => {
    getCidades();
  }, []);

  const getCidades = async () => {
    if (didRun.current) return;
    didRun.current = true;
    try {
      var dados = await getData('cidades');
      setCidades(dados.data || []);
      return dados;
    } catch (err) {
      toast.error('Erro ao carregar cidades!');
      throw err;
    }
  };

  const columns = [
    {
      accessorKey: 'nome',
      header: 'Nome da Bairro',
      cell: ({ row }) => (
        <div className="font-medium">{row.getValue('nome')}</div>
      ),
    },
    {
      accessorKey: 'nome_cidade',
      header: 'Cidade',
      cell: ({ row }) => (
        <div className="font-mono text-sm">{row.getValue('nome_cidade')}</div>
      ),
    }
  ];

  const formFields = [
    {
      name: 'nome',
      label: 'Nome do Bairro',
      type: 'text',
      required: true,
      placeholder: 'Digite o nome da bairro',
    },
    {
      name: 'id_cidade',
      label: 'Cidade do Bairro',
      type: 'select',
      required: true,
      placeholder: 'Selecione a cidade',
      options: cidades,
      labelField: 'nome',
      valueField: 'id',
    }
  ];

  return (
    <CRUDPage
      title="Bairros"
      entityType="bairros"
      columns={columns}
      formFields={formFields}
      newButtonLabel="Novo Bairro"
      searchPlaceholder="Buscar bairros..."
    />
  );
};

export default BairrosPage;

