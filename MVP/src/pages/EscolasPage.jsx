import React, { useEffect, useRef, useState } from 'react';
import { Badge } from '@/components/ui/badge';
import CRUDPage from '@/components/CRUDPage';
import * as XLSX from 'xlsx';
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import {getData} from '@/api';

const EscolasPage = () => {
  const didRun = useRef(false);

  const [cidades, setCidades] = useState([]);
  const [bairros, setBairros] = useState([]);

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

  const getBairros = async (id_cidade) => {
    try {
      var dados = await getData('bairros/cidade/' + id_cidade);
      setBairros(dados.data || []);
    } catch (err) {
      toast.error('Erro ao carregar bairros!');
      throw err;
    }
  };

  const columns = [
    {
      accessorKey: 'nome',
      header: 'Nome da Escola',
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
    },
    {
      accessorKey: 'nome_bairro',
      header: 'Bairro',
      cell: ({ row }) => (
        <div className="text-center">{row.getValue('nome_bairro')}</div>
      ),
    }
  ];

  const formFields = [
    {
      name: 'nome',
      label: 'Nome da Escola',
      type: 'text',
      required: true,
      placeholder: 'Digite o nome da escola'
    },
    {
      name: 'id_cidade',
      label: 'Cidade',
      type: 'select',
      required: true,
      placeholder: 'Selecione a cidade da escola',
      options: cidades,
      labelField: 'nome',
      valueField: 'id',
      callback: (value) => getBairros(value)
    },
    {
      name: 'id_bairro',
      label: 'Bairro',
      type: 'select',
      required: true,
      placeholder: 'Selecione o bairro da escola',
      options: bairros,
      labelField: 'nome',
      valueField: 'id'
    }
  ];

  return (
    <CRUDPage
      title="Escolas"
      entityType="escolas"
      columns={columns}
      formFields={formFields}
      newButtonLabel="Nova Escola"
      searchPlaceholder="Buscar escolas..."
    />
  );
};

export default EscolasPage;

