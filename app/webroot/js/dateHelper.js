var Mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"];

var ValMois = [1,4,4,0,2,5,0,3,6,1,4,6];
var NomJour = ["Samedi", "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];


/**
* @param	par défault on utilise la date qui est enregisté
* @return 	une table qui: [0]:JJ, [1]:MM, [2]:AAAA, [3]:HH, [4]:mm, [5]:ss
*/
 function eclatDate(date)
{

	var annee = date.substr(0, 4);

	var mois = date.substr(5, 2);

	var jour = date.substr(8, 2);	

	var heure = date.substr(11, 2);

	var minute = date.substr(14, 2);

	var seconde = date.substr(17, 2);

	return [jour, mois, annee, heure, minute, seconde];
}

function frDate(date) {
	date = eclatDate(date);
	return date[0]+'/'+date[1]+'/'+date[2];
}


/**
* @param	par défault on utilise la date qui est enregisté
* @return 	une chaine de caractere de la forme "JJ nomMois"
*/
function formatFrMois(date)
{

	dateEclate = eclatDate(date);

	date = dateEclate[0]+' '+Mois[dateEclate[1]-1];

	return date;
}


/**
* @param	par défault on utilise la date qui est enregisté
* @return 	une chaine de caractere de la forme "nomJour JJ nomMois AAAA"
*/
function formatJourMois(date)
{

	dateEclate = eclatDate(date);

	date = dateEclate[0]+' '+Mois[dateEclate[1]-1]+' '+dateEclate[2];

	return date;
}


/**
* @param	par défault on utilise la date qui est enregisté
* @return 	une chaine de caractere en fonction de la date donnée en parametre "Aujourd'hui", "Hier", le jour (si la date ne dépasse pas les 5jours) ou "JJ nomMois"
*			suivant la différence entre la date d'aujourd'hui est la date passé en parametre
*/
function dateRel(date)
{

	var nbMs = intervalMs(date);

	var unJour = 1000*60*60*24;
	
	if(nbMs < unJour)
	{
		retour = "Aujourd'hui";
	}
	
	else if(nbMs < unJour *2)
	{
		retour = "Hier";
	}
	
	else if(nbMs < unJour * 6)
	{
		retour = nomJour(date);
	}

	else if(nbMs < unJour * 356)
	{
		retour = formatFrMois(date);
	}
	
	else
	{
		retour = formatJourMois(date);
	}
	
	return retour;
	


}


/**
* @param	par défault on utilise la date qui est enregisté
* @return	renvoi le nom du jour de la date passé en parametre
*/
function nomJour(date)
{

	var dateEclate = eclatDate(date);
	var Mois = dateEclate[1];
	var decenie = substr(dateEclate[2], 2);

	var tmp = decenie / 4 + decenie;
	tmp = Math.round(tmp);
	
	tmp = tmp + dateEclate[0];

	tmp = tmp + ValMois[Mois-1];

	bissextile = ((dateEclate[2] % 4 == 0) && (dateEclate[2] % 100 != 0) || (dateEclate[2] % 400));
	if(bissextile && ((dateEclate[1] == 1) || (dateEclate[1] == 2)))
	{
		tmp = tmp - 1;
	}

	tmp = tmp + 6;

	tmp = tmp % 7;
	tmp = Math.round(tmp);


	return NomJour[tmp];
}


/**
* @param date à comparer avec la date d'aujourd'hui
* @return un entier qui correspond au nombre de Mseconds entre la date passé en parametre et la date d'aujourd'hui
*/
function intervalMs(date)
{
	date = new Date(date);

	var currentDate = new Date();

	var tmp = parseInt(parseInt(currentDate.getTime()) - parseInt(date.getTime));

	return tmp;
}
