import { Inter } from "next/font/google";
import "./globals.css";
import BootstrapClient from "./components/BootstrapClient";
import Header from "./components/header";
import Tabs from "./components/Tabs";

const inter = Inter({ subsets: ["latin"] });

export const metadata = {
  title: "Haber Sitesi",
  description: "Güncel Haber Sitesi",
};

export default function RootLayout({ children }) {
  return (
    <html lang='en'>
      <body className={inter.className}>
        <Header></Header>
        <Tabs></Tabs>
        {children}
        <BootstrapClient />
      </body>
    </html>
  );
}
