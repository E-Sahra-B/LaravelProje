import { Button, Container, TextField, Typography } from '@mui/material';
import Box from '@mui/system/Box';
import axios from 'axios';
import { useSession, signIn, signOut } from "next-auth/react"
import { useState } from 'react';


const login = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const girisYap = () => {
        axios.post("http://127.0.0.1:8000/api/auth/login", { email, password }).then(res => {
            signIn('credentials', { callbackUrl: '/', access_token: res?.data?.access_token, name: "a", id: res?.data?.access_token })
        })
        return
    }
    return (
        <>
            <Container maxWidth="sm">
                <Box sx={{
                    width: "100%",
                    margin: 'auto',
                    marginTop: '10%',
                    marginBottom: '30%',
                    padding: 3,
                    textAlign: 'center',
                    bordergroundColor: 'primary.dark', '&:hover': {
                        backgroundColor: 'primary.main',
                        opacity: [0.9, 0.8, 0.7],
                        border: '1px dashed #903ba7'
                    },
                    borderRadius: 2,
                    border: '1px dashed #903ba7'
                }}>
                    <Typography variant="h4" gutterBottom>Stok Takip Giriş</Typography>
                    <Box sx={{ padding: 3 }}><TextField onChange={e => setEmail(e.target.value)} style={{ width: "100%" }} id="outlined-basic" label="Kullanıcı Adı" variant="outlined" /></Box>
                    <Box sx={{ padding: 3 }}><TextField onChange={e => setPassword(e.target.value)} style={{ width: "100%" }} id="outlined-basic" label="Kullanıcı Şifre" variant="outlined" /></Box>
                    <Box sx={{ padding: 3, marginTop: 2 }}>
                        <Button onClick={() => girisYap()} style={{ width: "100%", height: "56px", backgroundColor: '#903ba7' }} variant="contained">Giriş Yap</Button>
                    </Box>
                </Box>
            </Container >
        </>
    )
}
export default login