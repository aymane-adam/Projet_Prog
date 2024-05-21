function deplacement(direction){
    a_step.play();
    let k = 0; //la prochaine abscisse
    let l = 0; //la prochaine ordonnée
    for(let i=0;i<max_length;i++){ //on parcours les abscisses
        for(let j=0;j<max_length;j++){ //et les ordonnées
            if(tabPerso[i][j]===1){ //on détecte où est le perso
                switch (direction){
                    case "haut": //on met où va le perso si il va en haut
                        while(collision(etage,i-1,j)===false){
                            k=i-1;
                            l=j;
                            tabPerso[k][l]=1; //on met le perso dans tabPerso
                            tabPerso[i][j]=0; //on efface l'ancien perso
                            i-=1;
                        }
                        break;
                    case "bas": //en bas 
                        while(collision(etage,i+1,j)===false){
                            k=i+1;
                            l=j;
                            tabPerso[k][l]=1; //on met le perso dans tabPerso
                            tabPerso[i][j]=0; //on efface l'ancien perso
                            i+=1;
                        }
                        break;
                    case "gauche": //à gauche
                        while(collision(etage,i,j-1)===false){
                            k=i;
                            l=j-1;
                            tabPerso[k][l]=1; //on met le perso dans tabPerso
                            tabPerso[i][j]=0; //on efface l'ancien perso
                            j-=1;
                        }
                        break;
                    case "droite": //à droite
                        while(collision(etage,i,j+1)===false){
                            k=i;
                            l=j+1;
                            tabPerso[k][l]=1; //on met le perso dans tabPerso
                            tabPerso[i][j]=0; //on efface l'ancien perso
                            j+=1;
                        }
                    break;
                }
            }
        }
    }
}