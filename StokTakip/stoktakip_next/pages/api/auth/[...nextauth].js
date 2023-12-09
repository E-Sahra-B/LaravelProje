import NextAuth from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";

export const authOptions = {
    providers: [
        CredentialsProvider({
            name: "Credentials",
            async authorize(credentials, req) {
                const user = { name: req.body.name, id: req.body.id };
                return user;
            },
        }),
    ],
    callbacks: {
        session: async (session, token, user) => {
            return session;
        },
    },
};
export default NextAuth(authOptions);
