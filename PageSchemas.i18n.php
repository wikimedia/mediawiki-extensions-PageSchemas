<?php

/**
 * Messages file for the PageSchemas extension
 *
 * @file
 * @ingroup Extensions
 */

/**
 * Get all extension messages
 *
 * @return array
 */
$messages = array();

$messages['en'] = array(
	'ps-desc' => 'Supports templates defining their data structure via XML markup',

	# FIXME: Is 'pageschemas-header' used anywhere? If not, please delete it from this file.
	'pageschemas-header' => 'The XML definition for this template is:',

	'ps-property-isproperty' => 'This is a property of type $1.',
	'ps-property-allowedvals' => 'The allowed {{PLURAL:$1|value for this property is|values for this property are}}:',
	'ps-schema-description' => 'Schema description:',
	'generatepages' => 'Generate pages',
	'ps-generatepages-desc' => 'Generate the following pages, based on this category\'s schema:',
	'ps-generatepages-success' => 'Pages will be generated.',
	'ps-generatepages-noschema' => 'Error: There is no page schema defined for this category.',
	'ps-page-desc-cat-not-exist' => 'This category does not exist yet. Create this category and its page schema:',
	'ps-page-desc-ps-not-exist' => 'This category exists, but does not have a page schema. Create schema:',
	'ps-page-desc-edit-schema' => 'Edit the page schema for this category:',
	'ps-delimiter-label' => 'Delimiter for values (default is ","):',
	'ps-multiple-temp-label' => 'Allow multiple instances of this template',
	'ps-field-list-label' => 'This field can hold a list of values',
	'ps-template' => 'Template',
	'ps-add-template' => 'Add template',
	'ps-remove-template' => 'Remove template',
	'ps-field' => 'Field',
	'ps-displaylabel' => 'Display label:',
	'ps-add-field' => 'Add field',
	'ps-remove-field' => 'Remove field',
	'ps-add-xml-label' => 'Additional XML:',
	'ps-schema-name-label' => 'Name of schema:',
	'editschema' => 'Edit schema',
);

/** Message documentation (Message documentation)
 * @author Ankit Garg
 */
$messages['qqq'] = array(
	'ps-desc' => '{{desc}}',
	'pageschemas-header' => 'Header to display XML definition in template page',
);

/** Afrikaans (Afrikaans)
 * @author Naudefj
 */
$messages['af'] = array(
	'ps-desc' => 'Ondersteun sjablone waarvoor die datastruktuur via XML gedefinieer is',
	'pageschemas-header' => 'Die XML-definisie vir die sjabloon is:',
);

/** Arabic (العربية)
 * @author Meno25
 */
$messages['ar'] = array(
	'ps-desc' => 'يدعم القوالب التي تعرف هيكل بياناتها من خلال علامات XML',
	'pageschemas-header' => 'تعريف XML لهذا القالب هو:',
);

/** Egyptian Spoken Arabic (مصرى)
 * @author Dudi
 * @author Ghaly
 */
$messages['arz'] = array(
	'ps-desc' => 'بيدعم القوالب اللى بتعرّف هيكل الداتا بتاعتها عن طريق علامات XML',
	'pageschemas-header' => 'تعريف XML للقالب ده هو:',
);

/** Belarusian (Taraškievica orthography) (‪Беларуская (тарашкевіца)‬)
 * @author EugeneZelenko
 * @author Jim-by
 * @author Renessaince
 * @author Wizardist
 */
$messages['be-tarask'] = array(
	'ps-desc' => 'Падтрымлівае шаблёны, якія вызначаюць уласную будову зьвестак праз XML-разьметку',
	'pageschemas-header' => 'XML-вызначэньне гэтага шаблёну:',
	'ps-property-isproperty' => 'Гэта ўласьцівасьць тыпу $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|Дазволенае значэньне|Дазволеныя значэньні}} для гэтай уласьцівасьці:',
	'ps-schema-description' => 'Апісаньне схемы:',
	'generatepages' => 'Стварыць старонкі',
	'ps-generatepages-desc' => 'Стварае наступныя старонкі, зыходзячы са схемы катэгорыі:',
	'ps-generatepages-success' => 'Старонкі будуць створаныя.',
	'ps-generatepages-noschema' => 'Памылка: для гэтае катэгорыі не апісаная схема старонкі.',
	'ps-page-desc-cat-not-exist' => 'Гэтая катэгорыя яшчэ не існуе. Стварыць яе і ейную схему старонкі:',
	'ps-page-desc-ps-not-exist' => 'Гэтая катэгорыя існуе, аднак ня мае схемы старонкі. Стварыць схему:',
	'ps-page-desc-edit-schema' => 'Рэдагаваць схему для гэтай катэгорыі:',
	'ps-delimiter-label' => 'Разьдзяляльнік для значэньняў (дапомна ","):',
	'ps-multiple-temp-label' => 'Дазволіць некалькі варыянтаў гэтага шаблёну',
	'ps-field-list-label' => 'Гэтае поле можа зьмяшчаць набор значэньняў',
	'ps-template' => 'Шаблён',
	'ps-add-template' => 'Дадаць шаблён',
	'ps-remove-template' => 'Выдаліць шаблён',
	'ps-field' => 'Поле',
	'ps-displaylabel' => 'Адлюстраваць пазнаку:',
	'ps-add-field' => 'Дадаць поле',
	'ps-remove-field' => 'Выдаліць поле',
	'ps-add-xml-label' => 'Дадатковы XML:',
	'ps-schema-name-label' => 'Назва схемы:',
	'editschema' => 'Рэдагаваць схему',
);

/** Breton (Brezhoneg)
 * @author Fulup
 */
$messages['br'] = array(
	'ps-desc' => 'Skorañ a ra ar patromoù dre dermeniñ o framm roadennoù gant balizennoù XML',
	'pageschemas-header' => 'Setu an termenadur XML evit ar patrom-mañ :',
);

/** Bosnian (Bosanski)
 * @author CERminator
 */
$messages['bs'] = array(
	'ps-desc' => 'Podržava šablone koji definiraju svoju strukturu podataka preko XML opisnog jezika',
	'pageschemas-header' => 'XML definicija za ovaj šablon je:',
);

/** German (Deutsch)
 * @author Imre
 * @author Kghbln
 */
$messages['de'] = array(
	'ps-desc' => 'Ermöglicht Vorlagen, die ihre Datenstruktur über XML auszeichnen',
	'pageschemas-header' => 'Die XML-Definition für diese Vorlage ist:',
	'ps-property-isproperty' => 'Dies ist ein Attribut vom Datentyp $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|Der zulässige Wert für dieses Attribut lautet|Die zulässigen Werte für dieses Attribut lauten}}:',
	'ps-schema-description' => 'Schemabeschreibung:',
	'generatepages' => 'Seiten generieren',
	'ps-generatepages-desc' => 'Die folgenden Seiten auf Basis des Schemas dieser Kategorie generieren:',
	'ps-generatepages-success' => 'Die Seiten werden generiert.',
	'ps-generatepages-noschema' => 'Fehler: Es wurde kein Schema für diese Kategorie definiert',
	'ps-page-desc-cat-not-exist' => 'Diese Kategorie ist noch nicht vorhanden. Erstelle diese Kategorie und ihr Schema:',
	'ps-page-desc-ps-not-exist' => 'Diese Kategorie ist vorhanden, verfügt aber noch nicht über ein Schema. Erstelle das Schema:',
	'ps-page-desc-edit-schema' => 'Bearbeite das Schema dieser Kategorie:',
	'ps-delimiter-label' => 'Trennzeichen für Werte (Standardwert ist „,“):',
	'ps-multiple-temp-label' => 'Diese Vorlage für mehrere Instanzen freigeben',
	'ps-field-list-label' => 'Dieses Feld kann eine Liste von Werten enthalten',
	'ps-template' => 'Vorlage',
	'ps-add-template' => 'Vorlage hinzufügen',
	'ps-remove-template' => 'Vorlage entfernen',
	'ps-field' => 'Feld',
	'ps-displaylabel' => 'Anzuzeigender Feldname:',
	'ps-add-field' => 'Feld hinzufügen',
	'ps-remove-field' => 'Feld entfernen',
	'ps-add-xml-label' => 'Zusätzliches XML:',
	'ps-schema-name-label' => 'Name des Schemas:',
	'editschema' => 'Schema bearbeiten',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'ps-page-desc-cat-not-exist' => 'Diese Kategorie ist noch nicht vorhanden. Erstellen Sie diese Kategorie und ihr Schema:',
	'ps-page-desc-ps-not-exist' => 'Diese Kategorie ist vorhanden, verfügt aber noch nicht über ein Schema. Erstellen Sie das Schema:',
	'ps-page-desc-edit-schema' => 'Bearbeiten Sie das Schema dieser Kategorie:',
);

/** Lower Sorbian (Dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'ps-desc' => 'Pódpěra pśedłogi, kótarež definěruju datowu strukturu pśez XML-wobznamjenjenja',
	'pageschemas-header' => 'XML-definicija za toś tu pśedłogu jo:',
);

/** Greek (Ελληνικά)
 * @author Περίεργος
 */
$messages['el'] = array(
	'ps-desc' => 'Υποστηρίζει πρότυπα που καθορίζουν τη δομή των δεδομένων τους μέσω της σήμανσης XML',
	'pageschemas-header' => 'Ο προσδιορισμός XML για αυτό το πρότυπο είναι:',
);

/** Spanish (Español)
 * @author Translationista
 */
$messages['es'] = array(
	'ps-desc' => 'Admite plantillas que definen su estructura de datos a través de XML',
	'pageschemas-header' => 'La definición XML para esta plantilla es:',
);

/** Finnish (Suomi)
 * @author Crt
 */
$messages['fi'] = array(
	'ps-desc' => 'Tukee mallineiden tietorakenteiden määrittelyä XML-merkkauskielen kautta.',
	'pageschemas-header' => 'XML-määritelmä tälle mallineelle on:',
);

/** French (Français)
 * @author Gomoko
 * @author PieRRoMaN
 */
$messages['fr'] = array(
	'ps-desc' => 'Supporte les modèle en définissant leur structure de données via des balises XML',
	'pageschemas-header' => 'La définition XML pour ce modèle est :',
	'ps-property-isproperty' => 'Cette propriété est de type $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|La valeur autorisée pour cette propriété est|Les valeurs autorisées pour cette propriété sont}}:',
	'ps-schema-description' => 'Description du schéma:',
	'generatepages' => 'Générer les pages',
	'ps-generatepages-desc' => "Générer les pages suivantes, d'après le schéma de cette catégorie:",
	'ps-generatepages-success' => 'Les pages seront générées.',
	'ps-generatepages-noschema' => "Erreur: il n'y a pas de schéma de page défini pour cette catégorie",
	'ps-page-desc-cat-not-exist' => "Cette catégorie n'existe pas encore. Créez-la avec son schéma de page:",
	'ps-page-desc-ps-not-exist' => "Cette catégorie existe, mais n'a pas de schéma de page. Créez le schéma:",
	'ps-page-desc-edit-schema' => 'Éditez le schéma de page pour cette catégorie:',
	'ps-delimiter-label' => 'Délimiteur pour les valeurs ("," par défaut):',
	'ps-multiple-temp-label' => 'Permet plusieurs instances de ce modèle',
	'ps-field-list-label' => 'Ce champ peut contenir une liste de valeurs',
	'ps-template' => 'Modèle',
	'ps-add-template' => 'Ajouter un modèle',
	'ps-remove-template' => 'Supprimer un modèle',
	'ps-field' => 'Champ',
	'ps-displaylabel' => 'Afficher le libellé:',
	'ps-add-field' => 'Ajouter un champ',
	'ps-remove-field' => 'Supprimer un champ',
	'ps-add-xml-label' => 'XML supplémentaire:',
	'ps-schema-name-label' => 'Nom du schéma:',
	'editschema' => 'Modifier le schéma',
);

/** Franco-Provençal (Arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'ps-desc' => 'Recognêt los modèlos en dèfenéssent lor structura de balyês avouéc des balises XML.',
	'pageschemas-header' => 'La dèfinicion XML por ceti modèlo est :',
	'ps-schema-description' => 'Dèscripcion du plan :',
	'generatepages' => 'Fâre les pâges',
	'ps-template' => 'Modèlo',
	'ps-add-template' => 'Apondre un modèlo',
	'ps-remove-template' => 'Enlevar un modèlo',
	'ps-field' => 'Champ',
	'ps-displaylabel' => 'Ètiquèta por la visualisacion :',
	'ps-add-field' => 'Apondre un champ',
	'ps-remove-field' => 'Enlevar un champ',
	'ps-add-xml-label' => 'XML de ples :',
	'ps-schema-name-label' => 'Nom du plan :',
	'editschema' => 'Changiér lo plan',
);

/** Galician (Galego)
 * @author MetalBrasil
 * @author Toliño
 */
$messages['gl'] = array(
	'ps-desc' => 'Soporta modelos que definen a súa estrutura de datos a través do formato XML',
	'pageschemas-header' => 'A definición XML para este modelo é:',
	'ps-property-isproperty' => 'Esta é unha propiedade de clase $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|O valor permitido|Os valores permitidos}} para esta propiedade {{PLURAL:$1|é|son}}:',
	'ps-schema-description' => 'Descrición do esquema:',
	'generatepages' => 'Xerar as páxinas',
	'ps-generatepages-desc' => 'Xerar as seguintes páxinas, segundo o esquema desta categoría:',
	'ps-generatepages-success' => 'As páxinas van ser xeradas.',
	'ps-generatepages-noschema' => 'Erro: Non hai ningún esquema de páxina definido para esta categoría.',
	'ps-page-desc-cat-not-exist' => 'Esta categoría aínda non existe. Cree esta categoría e o seu esquema de páxina:',
	'ps-page-desc-ps-not-exist' => 'A categoría existe, pero non ten un esquema de páxina. Cree o esquema:',
	'ps-page-desc-edit-schema' => 'Edite o esquema de páxina desta categoría:',
	'ps-delimiter-label' => 'Delimitador de valores (por defecto é ","):',
	'ps-multiple-temp-label' => 'Permitir varias instancias deste modelo',
	'ps-field-list-label' => 'Este campo pode conter unha lista de valores',
	'ps-template' => 'Modelo',
	'ps-add-template' => 'Engadir un modelo',
	'ps-remove-template' => 'Eliminar un modelo',
	'ps-field' => 'Campo',
	'ps-displaylabel' => 'Mostrar a etiqueta:',
	'ps-add-field' => 'Engadir un campo',
	'ps-remove-field' => 'Eliminar un campo',
	'ps-add-xml-label' => 'XML adicional:',
	'ps-schema-name-label' => 'Nome do esquema:',
	'editschema' => 'Editar o esquema',
);

/** Swiss German (Alemannisch)
 * @author Als-Holder
 */
$messages['gsw'] = array(
	'ps-desc' => 'Unterstitzt Vorlage, wu ihri Datestruktur iber XML-Markup definiere',
	'pageschemas-header' => 'D XML-Definition fir die Vorlag isch:',
);

/** Hebrew (עברית)
 * @author Amire80
 * @author YaronSh
 */
$messages['he'] = array(
	'ps-desc' => 'תמיכה בתבניות שמגדירות את מבנה הנתונים שלהן דרך XML',
	'pageschemas-header' => 'הגדרת ה־XML עבור תבנית זו היא:',
	'ps-property-isproperty' => 'זהו מאפיין מסוג $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|הערך התקין למאפיין הזה הוא|הערכים התקינים למאפיין הזה הם}}:',
	'ps-generate-pages' => 'יצירת דפים',
	'ps-generate-pages-desc' => 'לחולל את דפי הוויקי הבאים, לפי הסכֵמה של הקטגוריה הזאת:',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ps-desc' => 'Podpěruje předłohi, kotrež datowu strukturu přez XML-woznamjenjenja definuja',
	'pageschemas-header' => 'XML-definicija za tutu předłohu je:',
);

/** Hungarian (Magyar)
 * @author Dani
 */
$messages['hu'] = array(
	'ps-desc' => 'Lehetővé teszi, hogy a sablonok XML-jelölőnyelv segítségével definiálják az adatstruktúrájukat',
	'pageschemas-header' => 'A sablon XML-definíciója:',
);

/** Interlingua (Interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'ps-desc' => 'Appoia patronos que defini lor structura de datos via marcation XML',
	'pageschemas-header' => 'Le definition XML pro iste patrono es:',
	'ps-property-isproperty' => 'Isto es un proprietate del typo $1.',
	'ps-property-allowedvals' => 'Le {{PLURAL:$1|valor|valores}} permittite pro iste proprietate es:',
	'ps-schema-description' => 'Description del schema:',
	'generatepages' => 'Generar paginas',
	'ps-generatepages-desc' => 'Generar le sequente paginas a base del schema de iste categoria:',
	'ps-generatepages-success' => 'Le paginas essera generate.',
	'ps-generatepages-noschema' => 'Error: Il non ha un schema de pagina definite pro iste categoria.',
	'ps-page-desc-cat-not-exist' => 'Iste categoria non existe ancora. Crea iste categoria e su schema de pagina:',
	'ps-page-desc-ps-not-exist' => 'Iste categoria existe, ma non ha un schema de pagina. Crea le schema:',
	'ps-page-desc-edit-schema' => 'Modifica le schema de pagina pro iste categoria:',
	'ps-delimiter-label' => 'Delimitator pro valores (predefinition es ","):',
	'ps-multiple-temp-label' => 'Permitter plure instantias de iste patrono',
	'ps-field-list-label' => 'Iste campo pote tener un lista de valores',
	'ps-template' => 'Patrono',
	'ps-add-template' => 'Adder patrono',
	'ps-remove-template' => 'Remover patrono',
	'ps-field' => 'Campo',
	'ps-displaylabel' => 'Etiquetta pro monstrar:',
	'ps-add-field' => 'Adder campo',
	'ps-remove-field' => 'Remover campo',
	'ps-add-xml-label' => 'Additional XML:',
	'ps-schema-name-label' => 'Nomine del schema:',
	'editschema' => 'Modificar schema',
);

/** Indonesian (Bahasa Indonesia)
 * @author IvanLanin
 */
$messages['id'] = array(
	'ps-desc' => 'Mendukung templat untuk dapat mendefinisikan struktur data mereka melalui markah XML',
	'pageschemas-header' => 'Definisi XML untuk templat ini adalah:',
);

/** Igbo (Igbo)
 * @author Ukabia
 */
$messages['ig'] = array(
	'ps-desc' => 'Në nyé ike maka mkpurụ ihü, në nyé úchè maka ázú omárí ha nke shi édé XML',
	'pageschemas-header' => 'Úchè XML maka mkpurụ ihü nka bu:',
);

/** Italian (Italiano)
 * @author Beta16
 */
$messages['it'] = array(
	'pageschemas-header' => 'La definizione XML per questo template è:',
);

/** Japanese (日本語)
 * @author Fryed-peach
 * @author Schu
 */
$messages['ja'] = array(
	'ps-desc' => 'XML マークアップによってデータ構造を定義するテンプレートをサポートします。',
	'pageschemas-header' => 'このテンプレートの XML 定義は以下のようになっています:',
	'ps-property-isproperty' => 'これはタイプ $1 のプロパティです。',
	'ps-property-allowedvals' => '{{PLURAL:$1|このプロパティの値が|このプロパティの値が}}許可されています：',
	'ps-schema-description' => 'スキーマの説明：',
	'generatepages' => 'ページを生成',
	'ps-generatepages-desc' => 'このカテゴリのスキーマに基づいて、次のページを生成',
	'ps-generatepages-success' => 'ページが生成されます。',
	'ps-generatepages-noschema' => 'エラー：このカテゴリに定義されているページのスキーマはありません。',
	'ps-page-desc-cat-not-exist' => 'このカテゴリはまだ存在しません。このカテゴリとそのページのスキーマを作成します。',
	'ps-page-desc-ps-not-exist' => 'このカテゴリは存在しますが、ページのスキーマを持っていません。スキーマを作成：',
	'ps-page-desc-edit-schema' => 'このカテゴリのページのスキーマを編集：',
	'ps-delimiter-label' => '値の区切り文字 (デフォルトは "," )：',
	'ps-multiple-temp-label' => 'このテンプレートの複数のインスタンスを許可',
	'ps-field-list-label' => 'このフィールドは、値のリストを保持することができます',
	'ps-template' => 'テンプレート',
	'ps-add-template' => 'テンプレートを追加',
	'ps-remove-template' => 'テンプレートを削除',
	'ps-field' => 'フィールド',
	'ps-displaylabel' => '表示ラベル：',
	'ps-add-field' => 'フィールドを追加',
	'ps-remove-field' => 'フィールドを削除',
	'ps-add-xml-label' => '追加のXML：',
	'ps-schema-name-label' => 'スキーマの名前：',
	'editschema' => 'スキーマを編集',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'ps-desc' => 'Ongerschtöz, dat mer de Dateschtruktur vun Schablone övver en <i lang="en">XML</i> Fommaat beschrieve kann.',
	'pageschemas-header' => 'Di Schablon met <i lang="en">XML</i> beschrevve:',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'ps-desc' => 'Ënnerstëtzt Schablounen déi hir Date-Struktur per XML definéieren',
	'pageschemas-header' => "D'XML-Definitioun fir dës Schabloun ass:",
	'ps-schema-description' => 'Beschreiwung vum Schema:',
	'generatepages' => 'Säite generéieren',
	'ps-generatepages-desc' => 'Dës Säiten op der Basis vum Schema vun dëser Kategorie generéieren:',
	'ps-generatepages-success' => 'Säite gi generéiert.',
	'ps-generatepages-noschema' => 'Feeler: et ass kee Säite-Schema fir dës Kategorie definéiert',
	'ps-page-desc-cat-not-exist' => 'Dës Kategorie gëtt et nach net. Leet dës Kategorie an hire Säite-Schema un:',
	'ps-page-desc-ps-not-exist' => 'Dës Kategorie gëtt et, awer si huet nach kee Säite-Schema. Leet de Schema un:',
	'ps-page-desc-edit-schema' => 'De Säite-Schema fir dës Kategorie änneren:',
	'ps-multiple-temp-label' => 'Méi Instanze vun dësem Schema zouloossen',
	'ps-field-list-label' => 'An dësem Feld kann eng Lëscht vu Wäerter stoen',
	'ps-template' => 'Schabloun',
	'ps-add-template' => 'Schabloun derbäisetzen',
	'ps-remove-template' => 'Schablon ewechhuelen',
	'ps-field' => 'Feld',
	'ps-displaylabel' => 'Etiquette weisen:',
	'ps-add-field' => 'Feld derbäisetzen',
	'ps-remove-field' => 'Feld ewechhuelen',
	'ps-add-xml-label' => 'Zousätzlechen XML:',
	'ps-schema-name-label' => 'Numm vum Schema:',
	'editschema' => 'Schema änneren',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'ps-desc' => 'Поддржува шаблони со определување на нивниот податочнот состав користејќи XML-означување',
	'pageschemas-header' => 'XML-определбата за овој шаблон е:',
	'ps-property-isproperty' => 'Ова е својство од типот $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|Допуштената вредност за ова својство е|Допуштените вредности за ова својство се}}:',
	'ps-schema-description' => 'Опис на шемата',
	'generatepages' => 'Создај страници',
	'ps-generatepages-desc' => 'Создај ги следниве страници врз основа на шемата на категоријата:',
	'ps-generatepages-success' => 'Страниците ќе бидат создадени.',
	'ps-generatepages-noschema' => 'Грешка: оваа категорија нема определена шема на страници',
	'ps-page-desc-cat-not-exist' => 'Оваа категорија сè уште не постои. Создај ја категоријата и нејзината шема на страници:',
	'ps-page-desc-ps-not-exist' => 'Оваа категорија постои, но нема шема на страници. Создај шема:',
	'ps-page-desc-edit-schema' => 'Уреди ја шемата на страници за оваа категорија:',
	'ps-delimiter-label' => 'Одделвач за вредности (стандардниот е „,“):',
	'ps-multiple-temp-label' => 'Дозволи повеќе примероци на овој шаблон',
	'ps-field-list-label' => 'Ова поле може да содржи список на вредности',
	'ps-template' => 'Шаблон',
	'ps-add-template' => 'Додај шаблон',
	'ps-remove-template' => 'Отстрани шаблон',
	'ps-field' => 'Поле',
	'ps-displaylabel' => 'Натпис за приказ:',
	'ps-add-field' => 'Додај поле',
	'ps-remove-field' => 'Отстрани поле',
	'ps-add-xml-label' => 'Дополнителен XML:',
	'ps-schema-name-label' => 'Име на шемата:',
	'editschema' => 'Уреди шема',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'ps-desc' => 'Ondersteunt sjablonen die hun gegevensstructuur via XML-opmaak definiëren',
	'pageschemas-header' => 'De XML-definitie voor dit sjabloon luidt als volgt:',
	'ps-property-isproperty' => 'Dit is een eigenschap van type $1.',
	'ps-property-allowedvals' => 'De toegelaten {{PLURAL:$1|waarde voor deze eigenschap is|waarden voor deze eigenschap zijn}}:',
	'ps-schema-description' => 'Schemabeschrijving:',
	'generatepages' => "Pagina's aanmaken",
	'ps-generatepages-desc' => "Maak de volgende pagina's aan, gebaseerd op dit categorieschema:",
	'ps-generatepages-success' => "De pagina's worden aangemaakt.",
	'ps-generatepages-noschema' => 'Fout: Er is geen paginaschema voor deze categorie.',
	'ps-page-desc-cat-not-exist' => 'Deze categorie bestaat nog niet. Maak deze categorie en het bijbehorende paginaschema aan:',
	'ps-page-desc-ps-not-exist' => 'Deze categorie bestaat, maar heeft geen paginaschema. Maak het paginaschema aan:',
	'ps-page-desc-edit-schema' => 'Bewerkt het paginaschema voor deze categorie:',
	'ps-delimiter-label' => 'Scheidingsteken voor waarden (standaard ","):',
	'ps-multiple-temp-label' => 'Meerdere exemplaren van dit sjabloon toestaan',
	'ps-field-list-label' => 'Dit veld kan een lijst met waarden bevatten',
	'ps-template' => 'Sjabloon',
	'ps-add-template' => 'Sjabloon toevoegen',
	'ps-remove-template' => 'Sjabloon verwijderen',
	'ps-field' => 'Veld',
	'ps-displaylabel' => 'Label weergeven:',
	'ps-add-field' => 'Veld toevoegen',
	'ps-remove-field' => 'Veld verwijderen',
	'ps-add-xml-label' => 'Extra XML:',
	'ps-schema-name-label' => 'Schemanaam:',
	'editschema' => 'Schema bewerken',
);

/** Norwegian Nynorsk (‪Norsk (nynorsk)‬)
 * @author Harald Khan
 */
$messages['nn'] = array(
	'ps-desc' => 'Støttar malar som definerer datastrukturen sin gjennom XML-markering.',
	'pageschemas-header' => 'XML-definisjonen til denne malen er:',
);

/** Norwegian (bokmål)‬ (‪Norsk (bokmål)‬)
 * @author Nghtwlkr
 */
$messages['no'] = array(
	'ps-desc' => 'Støtter maler som definerer datastrukturen sin gjennom XML-markering',
	'pageschemas-header' => 'XML-definisjonen for denne malen er:',
);

/** Occitan (Occitan)
 * @author Cedric31
 */
$messages['oc'] = array(
	'ps-desc' => 'Supòrta los modèls en definissent lor estructura de donadas via de balisas XML',
	'pageschemas-header' => 'La definicion XML per aqueste modèl es :',
);

/** Polish (Polski)
 * @author Sp5uhe
 */
$messages['pl'] = array(
	'ps-desc' => 'Obsługa definiowania struktury szablonów z wykorzystaniem znaczników XML',
	'pageschemas-header' => 'Definicja XML dla tego szablonu:',
);

/** Piedmontese (Piemontèis)
 * @author Borichèt
 * @author Dragonòt
 */
$messages['pms'] = array(
	'ps-desc' => "A manten jë stamp ch'a definisso soa strutura dij dat via markup XML",
	'pageschemas-header' => "La definission XML për sto stamp-sì a l'é:",
);

/** Portuguese (Português)
 * @author Hamilton Abreu
 */
$messages['pt'] = array(
	'ps-desc' => 'Permite criar modelos, cuja estrutura de dados é definida através de uma notação XML',
	'pageschemas-header' => 'O modelo de dados em XML para esta predefinição é:',
	'ps-property-isproperty' => 'Esta é uma propriedade do tipo $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|O valor permitido para esta propriedade é|Os valores permitidos para esta propriedade são}}:',
	'ps-generate-pages' => 'Gerar Páginas',
	'ps-generate-pages-desc' => 'Gerar as seguintes páginas, com base no modelo de dados desta categoria:',
);

/** Brazilian Portuguese (Português do Brasil)
 * @author Daemorris
 */
$messages['pt-br'] = array(
	'ps-desc' => 'Suporta predefinições definindo suas estruturas de dados via marcação XML',
	'pageschemas-header' => 'A definição XML para esta predefinição é:',
);

/** Tarandíne (Tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'ps-desc' => "Le template de supporte definiscene 'a struttura lore ausanne l'XML",
	'pageschemas-header' => "'A definizione XML pe st'esembie jè:",
	'ps-property-isproperty' => "Queste jè 'na probbietà de tipe $1.",
	'ps-property-allowedvals' => "{{PLURAL:$1'U valore permesse pe sta probbietà jè|Le valore permesse pe ste probbietà sonde}}:",
	'ps-generate-pages' => 'Genera pàggene',
	'ps-generate-pages-desc' => 'Genere le pàggene ca seguene, basate sus a stu schema de categorije:',
);

/** Russian (Русский)
 * @author Александр Сигачёв
 */
$messages['ru'] = array(
	'ps-desc' => 'Поддерживает шаблоны с определением их структуры данных постредством XML-разметки',
	'pageschemas-header' => 'XML-определение этого шаблона:',
);

/** Slovenian (Slovenščina)
 * @author Dbc334
 */
$messages['sl'] = array(
	'ps-desc' => 'Podpira predloge, ki opredelujejo svojo zgradbo podatkov preko označevanja XML',
	'pageschemas-header' => 'Opredelitev XML predloge je:',
	'ps-property-isproperty' => 'To je lastnost vrste $1.',
	'ps-property-allowedvals' => '{{PLURAL:$1|Dovoljena vrednost te lastnosti je|Dovoljeni vrednosti te lastnosti sta|Dovoljene vrednosti te lastnosti so}}:',
	'ps-generate-pages' => 'Ustvarjajte strani',
	'ps-generate-pages-desc' => 'Ustvari naslednje strani, temelječe na shemi te kategorije:',
);

/** Serbian Cyrillic ekavian (‪Српски (ћирилица)‬)
 * @author Rancher
 */
$messages['sr-ec'] = array(
	'ps-desc' => 'Подршка шаблонима који дефинишу структуру података преко XML означавања',
	'pageschemas-header' => 'XML дефиниција овог шаблона:',
);

/** Swedish (Svenska)
 * @author Per
 */
$messages['sv'] = array(
	'ps-desc' => 'Stödjer mallar som definierar datastrukturen med XML-markering',
	'pageschemas-header' => 'XML-definitionen för denna mall är:',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'ps-desc' => 'Tumatangkilik sa mga suleras na nagbibigay kahulugan sa kanilang kayarian ng dato sa pamamagitan ng pagmarkang XML',
	'pageschemas-header' => 'Ang kahulugang XML para sa suleras na ito ay:',
);

/** Turkish (Türkçe)
 * @author Vito Genovese
 */
$messages['tr'] = array(
	'ps-desc' => 'XML işaretlemesi ile veri yapılarını tanımlayan şablonları destekler',
	'pageschemas-header' => 'Bu şablon için XML tanımı şu şekilde:',
);

/** Ukrainian (Українська)
 * @author NickK
 * @author Prima klasy4na
 * @author Тест
 */
$messages['uk'] = array(
	'ps-desc' => 'Підтримує визначення структури даних шаблонів за допомогою розмітки XML',
	'pageschemas-header' => 'XML-визначення для цього шаблону:',
);

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 */
$messages['vi'] = array(
	'ps-desc' => 'Cho phép định nghĩa cấu trúc dữ liệu của bản mẫu dùng mã XML',
	'pageschemas-header' => 'Định nghĩa XML của bản mẫu này là:',
);

/** Simplified Chinese (‪中文(简体)‬)
 * @author Chenxiaoqino
 */
$messages['zh-hans'] = array(
	'ps-desc' => '支持的模版已将其数据结构用XML代码声明。',
	'pageschemas-header' => '此模版的XML定义是：',
);

/** Traditional Chinese (‪中文(繁體)‬)
 * @author Mark85296341
 */
$messages['zh-hant'] = array(
	'ps-desc' => '支援的模版已將其資料結構用 XML 代碼聲明。',
	'pageschemas-header' => '此模版的 XML 定義是：',
);

