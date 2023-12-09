import * as React from 'react';
import { useState, useEffect } from 'react';
import { Box, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper, Container, Button, TextField, Dialog, DialogActions, DialogContent, DialogTitle } from '@mui/material';
import Header from '../components/Header';
import { Delete, Edit } from '@mui/icons-material';
import axios from 'axios';
import { useSession, signIn, signOut } from "next-auth/react"
import { useRouter } from 'next/router'

export default function ButtonAppBar() {
  const { data: session, status } = useSession()
  const router = useRouter()
  const [rows, setRows] = useState([]);
  const [seciliId, setSeciliId] = useState(null);
  const [urunAdi, setUrunAdi] = useState(null);
  const [urunFiyati, setUrunFiyati] = useState(null);
  const [urunStok, setUrunStok] = useState(null);
  const [open, setOpen] = useState(false);
  const [deleteOpen, setDeleteOpen] = useState(false);

  function get() {
    axios.post('http://127.0.0.1:8000/api/stoktakip/read', { "token": session?.token?.sub }).then(res => {
      // axios.post('http://127.0.0.1:8000/api/stoktakip/read').then(res => {
      setRows(res.data);
    })
  }
  useEffect(() => {
    if (status == "unauthenticated") {
      router.push("/login")
    } else if (status == "authenticated") {
      get();
    }
  }, [status])

  const saveBtn = () => {
    seciliId != null ? update() : create();
  };
  function create() {
    axios.post('http://127.0.0.1:8000/api/stoktakip/create', {
      "urun_adi": urunAdi,
      "urun_fiyati": urunFiyati,
      "urun_stok": urunStok,
      "token": session?.token?.sub
    }).then(res => {
      get();
    })
    clear();
  }
  function update() {
    axios.post('http://127.0.0.1:8000/api/stoktakip/update', {
      "id": seciliId,
      "urun_adi": urunAdi,
      "urun_fiyati": urunFiyati,
      "urun_stok": urunStok,
      "token": session?.token?.sub
    }).then(res => {
      get();
    })
    clear();
  }
  function deleteFunc() {
    axios.post('http://127.0.0.1:8000/api/stoktakip/delete', {
      "id": seciliId,
      "token": session?.token?.sub
    }).then(res => {
      get();
      setDeleteOpen(false);
    })
  }
  const clear = () => {
    setUrunAdi(null);
    setUrunFiyati(null);
    setUrunStok(null);
    setSeciliId(null);
    setOpen(false);
  }

  const handleClickOpen = () => {
    setOpen(true);
  };
  const handleClose = () => {
    clear();
  };
  const handleUpdateClickOpen = (row) => {
    setSeciliId(row.id);
    setUrunAdi(row.urun_adi);
    setUrunFiyati(row.urun_fiyati);
    setUrunStok(row.urun_stok);
    setOpen(true);
  };
  const handleDeleteClickOpen = (row) => {
    setSeciliId(row.id);
    setDeleteOpen(true);
  };
  const handleDeleteClose = () => {
    setDeleteOpen(false);
  };

  return (
    <>
      <Box sx={{ flexGrow: 1 }}>
        <Header></Header></Box>
      <br />
      <Container maxWidth="lg">
        <Button variant="contained" onClick={handleClickOpen}>Ürün Ekle</Button><br />
        <TableContainer component={Paper}>
          <Table sx={{ minWidth: 650 }} aria-label="simple table">
            <TableHead>
              <TableRow>
                <TableCell>Ürün Adı</TableCell>
                <TableCell align="right">Ürün Fiyatı</TableCell>
                <TableCell align="right">Ürün Stoğu</TableCell>
                <TableCell align="right">Ayarlar</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {rows.map((row) => (
                <TableRow
                  key={row.id}
                  sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                >
                  <TableCell component="th" scope="row">
                    {row.urun_adi}
                  </TableCell>
                  <TableCell align="right">{row.urun_fiyati}</TableCell>
                  <TableCell align="right">{row.urun_stok}</TableCell>
                  <TableCell align="right"><Delete onClick={() => handleDeleteClickOpen(row)} /><Edit onClick={() => handleUpdateClickOpen(row)} /></TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>
      </Container>

      {/* Create Urun */}
      <Dialog open={open} onClose={handleClose}>
        <DialogTitle>Ürün Ekle</DialogTitle>
        <DialogContent>
          <TextField
            autoFocus
            margin="dense"
            id="name"
            label="Ürün Adı"
            type="text"
            fullWidth
            variant="standard"
            value={urunAdi}
            onChange={e => { setUrunAdi(e.target.value) }}
          />
          <TextField
            autoFocus
            margin="dense"
            id="name"
            label="Ürün Fiyatı"
            type="number"
            fullWidth
            variant="standard"
            value={urunFiyati}
            onChange={e => { setUrunFiyati(e.target.value) }}
          />
          <TextField
            autoFocus
            margin="dense"
            id="name"
            label="Ürün Stogu"
            type="number"
            fullWidth
            variant="standard"
            value={urunStok}
            onChange={e => { setUrunStok(e.target.value) }}
          />
        </DialogContent>
        <DialogActions>
          <Button onClick={handleClose}>Vazgeç</Button>
          <Button onClick={saveBtn}>Kaydet</Button>
        </DialogActions>
      </Dialog>

      {/* Delete Urun */}
      <Dialog open={deleteOpen} onClose={handleDeleteClose}>
        <DialogTitle>Ürün Ekle</DialogTitle>
        <DialogContent>
          Bu Ürünü Silmek İstediğinizden Emin Misiniz?
        </DialogContent>
        <DialogActions>
          <Button onClick={handleDeleteClose}>Vazgeç</Button>
          <Button onClick={deleteFunc}>Sil</Button>
        </DialogActions>
      </Dialog>
    </>
  );
}
