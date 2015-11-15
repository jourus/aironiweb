<%

'colore di sfondo delle pagina
coloresfondopag="#FFFFFF"

'nome del dns  
strConnString="DSN=AironiGara4;DATABASE=airo;uid=sa;pwd=G4ltrucc0!;"



'strConnString = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=C:\andrea\airo\acessolocal.mdb"

'nome del file che viene utilizzato come standard nel podio in caso di mancanza di foto.
fotopodiostandard="spaziatore.gif"

'numero di piazzzole totale
NumeroPiazzoleGara=24

' 2011.03.27 GFF Il numero massimo di arcieri è un parametro
MaxRigheArcieriInClassifica = 24

pathfotogeneriche="C:\andrea\airo\sito\immagini\fotolibere\"
pathVideogeneriche="C:\andrea\airo\sito\immagini\videoliberi\"


    Function URLDecode(S3Decode)
        
        Dim S3Temp(1,1)
        Dim S3In, S3Out, S3Pos, S3Len, S3i, S3Asc

        S3In  = S3Decode
        S3Out = ""
        S3In  = Replace(S3In, "+", " ")
        S3Pos = Instr(S3In, "%")
    
        Do While S3Pos
            S3Len = Len(S3In)
            If S3Pos > 1 Then S3Out = S3Out & Left(S3In, S3Pos - 1)
            S3Temp(0,0) = Mid(S3In, S3Pos + 1, 1)
            S3Temp(1,0) = Mid(S3In, S3Pos + 2, 1)
        
            For S3i = 0 to 1
                S3Asc = Asc(S3Temp(S3i,0))
                If S3Asc > 47 And S3Asc < 58 Then
                    S3Temp(S3i,1) = S3Asc - 48
                ElseIf (S3Asc > 96 And S3Asc < 103) Then
                    S3Temp(S3i,1) = S3Asc - 97 + 10
                Else
                    S3Temp(S3i,1) = S3Asc - 65 + 10
                End If
            Next
        
            S3Out = S3Out & Chr((S3Temp(0,1) * 16) + S3Temp(1,1))
            S3In  = Right(S3In, (S3Len - (S3Pos + 2)))
            S3Pos = Instr(S3In, "%")
        
        Loop
    
        URLDecode = S3Out & S3In
    End Function


Function apiciaposto(valore) 

apiciaposto=Replace(valore,"'", "''") 


end function 



%>






