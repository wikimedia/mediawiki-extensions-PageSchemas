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
	'ps-desc' => 'Defines the data structure for all pages in a category using XML',
	'ps-schema-description' => 'Page schema',
	'generatepages' => 'Generate pages',
	'ps-generatepages-desc' => 'Generate the following pages, based on this category\'s schema:',
	'ps-generatepages-success' => 'The selected pages will be generated.',
	'ps-generatepages-noschema' => 'Error: There is no page schema defined for this category.',
	'ps-generatepages-editsummary' => 'Generated from a page schema',
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
	'ps-namelabel' => 'Name:',
	'ps-displaylabel' => 'Display label:',
	'ps-add-field' => 'Add field',
	'ps-remove-field' => 'Remove field',
	'ps-add-xml-label' => 'Additional XML:',
	'ps-optional-name' => 'Name (leave blank to set to field name):',
	'editschema' => 'Edit schema',
	'createschema' => 'Create schema',
	'right-generatepages' => 'View "{{int:generatepages}}" tab and page',
	'action-generatepages' => 'view the "{{int:generatepages}}" tab and page',
	'ps-add-section' => 'Add section',
	'ps-removepagesection' => 'Remove section',
	'ps-sectionname' => 'Section name:',
	'ps-sectionlevel' => 'Section level:',
	'ps-section' => 'Section',
	'ps-level' => 'Level',
	'ps-otherparams' => 'Other parameters',
	'ps-createpage-irregulartext' => 'Wiki page "$1" does not hold regular wikitext.',
	'ps-createpage-invalidtitle' => 'Invalid title',
	'ps-createpage-notfound' => 'Article not found',
	'ps-field-display-always' => 'Display this field always',
	'ps-field-display-notempty' => 'Display if not empty',
	'ps-field-display-hide' => 'Hide',
	'ps-field-namespace' => 'This field will always have values in the following namespace:',
);

/** Message documentation (Message documentation)
 * @author Ankit Garg
 * @author EugeneZelenko
 * @author Protnet
 * @author Purodha
 * @author Raymond
 * @author Shirayuki
 * @author Siebrand
 */
$messages['qqq'] = array(
	'ps-desc' => '{{desc|name=Page Schemas|url=http://www.mediawiki.org/wiki/Extension:Page_Schemas}}',
	'generatepages' => '{{doc-special|GeneratePages}}
Used as label for the tab.

Used in:
* {{msg-mw|Right-generatepages}}
* {{msg-mw|Action-generatepages}}',
	'ps-delimiter-label' => 'Used as label for delimiter of values.
{{Identical|Delimiter for values (default is ","):}}',
	'ps-field-list-label' => 'Label for is_list checkbox.
{{Identical|This field can hold a list of values}}',
	'ps-template' => 'A MediaWiki template.
{{Identical|Template}}',
	'ps-add-template' => '{{Identical|Add template}}',
	'ps-remove-template' => 'The text on a button that removes the current template.
{{Identical|Remove template}}',
	'ps-field' => 'A "field" here is both a template parameter and a form field.
{{Identical|Field}}',
	'ps-namelabel' => '{{Identical|Name}}',
	'ps-displaylabel' => 'The term for the text that shows up next to a field when it is displayed',
	'ps-remove-field' => 'The text on a button that removes the current field',
	'editschema' => '{{doc-special|EditSchema}}
Also used as tab name.',
	'createschema' => 'Tab name',
	'right-generatepages' => '{{doc-right|generatepages}}
Refers to {{msg-mw|Generatepages}}.',
	'action-generatepages' => '{{doc-action|generatepages}}
Refers to {{msg-mw|generatepages}}.',
	'ps-add-section' => 'Used as label for the button.
{{Identical|Add section}}',
	'ps-removepagesection' => 'The text on the button that removes the current section.
{{Identical|Remove section}}',
	'ps-sectionname' => 'Used as label for "Section name" input box.
{{Identical|Section name}}',
	'ps-sectionlevel' => 'Used as label for "Section level" select box.
{{Identical|Section level}}',
	'ps-section' => 'A page section. {{Identical|Section}}',
	'ps-level' => "The level, or number of '='s, in a section's header.
{{Identical|Level}}",
	'ps-otherparams' => '{{Identical|Other parameter}}',
	'ps-createpage-irregulartext' => 'Error message when the text input is irregular.
Parameter:
* $1 is the wikipage with irregular text',
	'ps-createpage-invalidtitle' => 'Error message when the title requested is invalid.
{{Identical|Invalid title}}',
	'ps-createpage-notfound' => 'Error message when the requested article is not found.',
	'ps-field-display-always' => 'Label for radio button for always display.

See also:
* {{msg-mw|ps-field-display-notempty}}
* {{msg-mw|ps-field-display-hide}}',
	'ps-field-display-hide' => 'Label for radio button for display hide.

See also:
* {{msg-mw|ps-field-display-notempty}}
* {{msg-mw|ps-field-display-always}}
{{Identical|Hide}}',
	'ps-field-namespace' => 'Label for an input holding the name of a MediaWiki namespace.',
);

/** Afrikaans (Afrikaans)
 * @author Naudefj
 * @author Winstonza
 */
$messages['af'] = array(
	'ps-desc' => 'Ondersteun sjablone waarvoor die datastruktuur via XML gedefinieer is', # Fuzzy
	'ps-field' => 'Veld',
	'ps-namelabel' => 'Naam:',
	'ps-createpage-invalidtitle' => 'Ongeldige titel',
	'ps-createpage-notfound' => 'Artikel nie gevind',
);

/** Arabic (العربية)
 * @author Meno25
 * @author زكريا
 */
$messages['ar'] = array(
	'ps-desc' => 'يدعم القوالب التي تعرف هيكل بياناتها من خلال علامات XML', # Fuzzy
	'ps-add-template' => 'أضف القالب',
	'ps-remove-template' => 'أزل القالب',
);

/** Egyptian Spoken Arabic (مصرى)
 * @author Dudi
 * @author Ghaly
 */
$messages['arz'] = array(
	'ps-desc' => 'بيدعم القوالب اللى بتعرّف هيكل الداتا بتاعتها عن طريق علامات XML', # Fuzzy
);

/** Asturian (asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'ps-desc' => "Define la estructura de datos de toles páxines d'una categoría usando XML",
	'ps-schema-description' => 'Esquema de la páxina',
	'generatepages' => 'Xenerar páxines',
	'ps-generatepages-desc' => "Xenerar les siguientes páxines, basaes nel esquema d'esta categoría:",
	'ps-generatepages-success' => 'Van xenerase les páxines esbillaes.',
	'ps-generatepages-noschema' => 'Error: Nun hai nengún esquema de páxina definíu pa esta categoría.',
	'ps-generatepages-editsummary' => 'Xenerada dende un esquema de páxina',
	'ps-page-desc-cat-not-exist' => "Esta categoría inda nun existe. Cree esta categoría ya'l so esquema de páxina:",
	'ps-page-desc-ps-not-exist' => "Esta categoría existe, pero nun tien un esquema de páxina. Cree l'esquema:",
	'ps-page-desc-edit-schema' => "Edite l'esquema de páxina d'esta categoría:",
	'ps-delimiter-label' => 'Llende pa los valores (el predetermináu ye ","):',
	'ps-multiple-temp-label' => "Permitir instancies múltiples d'esta plantía",
	'ps-field-list-label' => 'Esti campu pue contener una llista de valores',
	'ps-template' => 'Plantía',
	'ps-add-template' => 'Añadir plantía',
	'ps-remove-template' => 'Desaniciar plantía',
	'ps-field' => 'Campu',
	'ps-namelabel' => 'Nome:',
	'ps-displaylabel' => 'Amosar la etiqueta:',
	'ps-add-field' => 'Agregar campu',
	'ps-remove-field' => 'Desaniciar campu',
	'ps-add-xml-label' => 'XML añadíu:',
	'ps-optional-name' => 'Nome (dexar balero pa facelu igual al nome del campu):',
	'editschema' => "Editar l'esquema",
	'createschema' => "Crear l'esquema",
	'right-generatepages' => 'Ver la llingüeta y la páxina «{{int:generatepages}}»',
	'action-generatepages' => 'ver la llingüeta y la páxina «{{int:generatepages}}»',
	'ps-add-section' => 'Amestar seición',
	'ps-removepagesection' => 'Desaniciar seición',
	'ps-sectionname' => 'Nome de la seición:',
	'ps-sectionlevel' => 'Nivel de seición:',
	'ps-section' => 'Seición',
	'ps-level' => 'Nivel',
	'ps-otherparams' => 'Otros parámetros',
	'ps-createpage-irregulartext' => 'La páxina wiki "$1" nun contién testu wiki regular.',
	'ps-createpage-invalidtitle' => 'Títulu inválidu',
	'ps-createpage-notfound' => "Nun s'alcontró l'artículu",
	'ps-field-display-always' => 'Amosar esti campu siempre',
	'ps-field-display-notempty' => 'Amosar si nun ta baleru',
	'ps-field-display-hide' => 'Anubrir',
	'ps-field-namespace' => 'Esti campu siempre tendrá valores del siguiente espaciu de nomes:',
);

/** South Azerbaijani (تورکجه)
 * @author Mousa
 */
$messages['azb'] = array(
	'ps-desc' => 'ایکس‌اِل‌اِل ایله بیر بؤلمه‌ده بوتون صحیفه‌لره دیتا قورولوشو تعریف ائدر',
	'ps-schema-description' => 'صحیفه شِماسی',
	'generatepages' => 'صحیفه‌لر یارات',
	'ps-generatepages-desc' => 'بو بؤلمه‌نین شِماسینا اسا، بو صحیفه‌لری یارات:',
	'ps-generatepages-success' => 'سئچیلمیش صحیفه‌لر یارادیلاجاقلار.',
	'ps-generatepages-noschema' => 'خطا: بو بؤلمه اوچون هئچ بیر صحیفه شِماسی تعریف اولونمویوب‌دور.',
	'ps-generatepages-editsummary' => 'بیر صحیفه شِماسینا اساس یارادیلیب‌دیر',
	'ps-page-desc-cat-not-exist' => 'بو بؤلمه هله‌لیک یوخدور. بو بؤلمه‌نی و اونون صحیفه شِماسینی یارات:',
	'ps-page-desc-ps-not-exist' => 'بو بؤلمه واردیر، اما اونون بیر صحیفه شِماسی یوخدور. شِما یارات:',
	'ps-page-desc-edit-schema' => 'بو بؤلمه اوچون صحیفه شِماسینی دَییشدیر:',
	'ps-delimiter-label' => 'دَیَرلر اوچون آیریشدیران (ایلک دَیَر «,»-دور):',
	'ps-multiple-temp-label' => 'بو شابلونون چوخلو نومونه‌سینی ایجازه وئر',
	'ps-field-list-label' => 'بو فیلد، دَیَرلر لیستینی ساخلایا بیلر',
	'ps-template' => 'شابلون',
	'ps-add-template' => 'شابلون آرتیر',
	'ps-remove-template' => 'شابلون سیل',
	'ps-field' => 'فیلد',
	'ps-namelabel' => 'آد:',
	'ps-displaylabel' => 'گؤسترمک برچسبی:',
	'ps-add-field' => 'فیلد آرتیر',
	'ps-remove-field' => 'فیلدی سیل',
	'ps-add-xml-label' => 'آرتیق ایکس‌اِم‌اِل:',
	'ps-optional-name' => 'آد (فیلد آدینا تنظیم‌له‌مک اوچون بوش بوراخ):',
	'editschema' => 'شِمانی دَییشدیر',
	'createschema' => 'شِما یارات',
	'right-generatepages' => '«صحیفه‌لر یارات» بؤلومو و صحیفه‌سینه باخین',
	'action-generatepages' => '«صحیفه‌لر یارات» بؤلومو و صحیفه‌سینه باخین', # Fuzzy
);

/** Belarusian (Taraškievica orthography) (беларуская (тарашкевіца)‎)
 * @author EugeneZelenko
 * @author Jim-by
 * @author Renessaince
 * @author Wizardist
 */
$messages['be-tarask'] = array(
	'ps-desc' => 'Вызначае структуру зьвестак для ўсіх старонак катэгорыі з дапамогай разьметкі XML',
	'ps-schema-description' => 'Схема старонкі',
	'generatepages' => 'Стварыць старонкі',
	'ps-generatepages-desc' => 'Стварае наступныя старонкі, зыходзячы са схемы катэгорыі:',
	'ps-generatepages-success' => 'Будуць створаныя выбраныя старонкі.',
	'ps-generatepages-noschema' => 'Памылка: для гэтай катэгорыі ня вызначаная схема старонкі.',
	'ps-generatepages-editsummary' => 'Створаная са схемы старонкі',
	'ps-page-desc-cat-not-exist' => 'Гэтая катэгорыя яшчэ не існуе. Стварыць яе са схемай старонкі:',
	'ps-page-desc-ps-not-exist' => 'Гэтая катэгорыя існуе, аднак ня мае схемы старонкі. Стварыць схему:',
	'ps-page-desc-edit-schema' => 'Рэдагаваць схему старонак для гэтай катэгорыі:',
	'ps-delimiter-label' => 'Разьдзяляльнік для значэньняў (па змоўчваньні «,»):',
	'ps-multiple-temp-label' => 'Дазволіць некалькі варыянтаў гэтага шаблёну',
	'ps-field-list-label' => 'Гэтае поле можа зьмяшчаць набор значэньняў',
	'ps-template' => 'Шаблён',
	'ps-add-template' => 'Дадаць шаблён',
	'ps-remove-template' => 'Выдаліць шаблён',
	'ps-field' => 'Поле',
	'ps-namelabel' => 'Назва:',
	'ps-displaylabel' => 'Паказваць пазнаку:',
	'ps-add-field' => 'Дадаць поле',
	'ps-remove-field' => 'Выдаліць поле',
	'ps-add-xml-label' => 'Дадатковы XML:',
	'editschema' => 'Рэдагаваць схему',
	'createschema' => 'Стварыць схему',
);

/** Bulgarian (български)
 * @author DCLXVI
 * @author පසිඳු කාවින්ද
 */
$messages['bg'] = array(
	'ps-field' => 'Поле',
	'ps-namelabel' => 'Име:',
);

/** Breton (brezhoneg)
 * @author Fohanno
 * @author Fulup
 * @author Y-M D
 */
$messages['br'] = array(
	'ps-desc' => 'Termeniñ a ra framm ar roadennoù evit holl bajennoù ur rummad bennak en ur ober gant XML',
	'ps-schema-description' => 'Chema ar bajenn',
	'generatepages' => 'Genel ar pajennoù',
	'ps-multiple-temp-label' => 'Aotren meur a eilad eus ar patrom-mañ',
	'ps-field-list-label' => "Ne c'hall ket ar vaezienn-mañ bezañ ur roll talvoudoù enni",
	'ps-template' => 'Patrom',
	'ps-add-template' => 'Ouzhpennañ ur patrom',
	'ps-remove-template' => 'Lemel ur patrom',
	'ps-field' => 'Maezienn',
	'ps-namelabel' => 'Anv :',
	'ps-displaylabel' => 'Tikedenn diskwel :',
	'ps-add-field' => 'Ouzhpennañ ur vaezienn',
	'ps-remove-field' => 'Lemel ar vaezienn',
	'editschema' => 'Kemmañ ar chema',
	'createschema' => 'Krouiñ ur chema',
);

/** Bosnian (bosanski)
 * @author CERminator
 */
$messages['bs'] = array(
	'ps-desc' => 'Podržava šablone koji definiraju svoju strukturu podataka preko XML opisnog jezika', # Fuzzy
);

/** Czech (čeština)
 * @author Vks
 */
$messages['cs'] = array(
	'ps-namelabel' => 'Název:',
);

/** Church Slavic (словѣньскъ / ⰔⰎⰑⰂⰡⰐⰠⰔⰍⰟ)
 * @author ОйЛ
 */
$messages['cu'] = array(
	'ps-namelabel' => 'имѧ :',
);

/** German (Deutsch)
 * @author Imre
 * @author Kghbln
 * @author Metalhead64
 */
$messages['de'] = array(
	'ps-desc' => 'Ermöglicht, unter Verwendung von XML, das Definieren einer Datenstruktur für alle Seiten in einer Kategorie',
	'ps-schema-description' => 'Seitenschema:',
	'generatepages' => 'Seiten generieren',
	'ps-generatepages-desc' => 'Die folgenden Seiten auf Basis des Schemas dieser Kategorie generieren:',
	'ps-generatepages-success' => 'Die ausgewählten Seiten werden generiert.',
	'ps-generatepages-noschema' => 'Fehler: Es wurde kein Schema für diese Kategorie definiert.',
	'ps-generatepages-editsummary' => 'Auf Basis eines Seitenschemas generiert',
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
	'ps-namelabel' => 'Name:',
	'ps-displaylabel' => 'Anzuzeigender Feldname:',
	'ps-add-field' => 'Feld hinzufügen',
	'ps-remove-field' => 'Feld entfernen',
	'ps-add-xml-label' => 'Zusätzliches XML:',
	'ps-optional-name' => 'Name (leer lassen, um den Feldnamen zu verwenden):',
	'editschema' => 'Schema bearbeiten',
	'createschema' => 'Schema erstellen',
	'right-generatepages' => 'Den Reiter „{{int:generatepages}}“ sowie die entsprechende Seite sehen',
	'action-generatepages' => 'den Reiter „{{int:Generatepages}}“ sowie die entsprechende Seite zu sehen',
	'ps-add-section' => 'Abschnitt hinzufügen',
	'ps-removepagesection' => 'Abschnitt entfernen',
	'ps-sectionname' => 'Abschnittsname:',
	'ps-sectionlevel' => 'Abschnittsebene:',
	'ps-section' => 'Abschnitt',
	'ps-level' => 'Ebene',
	'ps-otherparams' => 'Andere Parameter',
	'ps-createpage-irregulartext' => 'Die Wikiseite „$1“ enthält keinen normalen Wikitext.',
	'ps-createpage-invalidtitle' => 'Ungültiger Titel',
	'ps-createpage-notfound' => 'Artikel nicht gefunden',
	'ps-field-display-always' => 'Dieses Feld immer anzeigen',
	'ps-field-display-notempty' => 'Anzeigen, falls nicht leer',
	'ps-field-display-hide' => 'Verstecken',
	'ps-field-namespace' => 'Dieses Feld hat immer Werte im folgenden Namensraum:',
);

/** German (formal address) (Deutsch (Sie-Form)‎)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'ps-page-desc-cat-not-exist' => 'Diese Kategorie ist noch nicht vorhanden. Erstellen Sie diese Kategorie und ihr Schema:',
	'ps-page-desc-ps-not-exist' => 'Diese Kategorie ist vorhanden, verfügt aber noch nicht über ein Schema. Erstellen Sie das Schema:',
	'ps-page-desc-edit-schema' => 'Bearbeiten Sie das Schema dieser Kategorie:',
);

/** Zazaki (Zazaki)
 * @author Erdemaslancan
 * @author Mirzali
 */
$messages['diq'] = array(
	'ps-template' => 'Şablon',
	'ps-field' => 'Ca',
	'ps-namelabel' => 'Name:',
	'ps-field-display-hide' => 'Bınımne',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'ps-desc' => 'Definěrujo strukturu datow za wšykne boki w kategoriji z pomocu XML',
);

/** Greek (Ελληνικά)
 * @author Protnet
 * @author Περίεργος
 */
$messages['el'] = array(
	'ps-desc' => 'Καθορίζει τη δομή των δεδομένων για όλες τις σελίδες χρησιμοποιώντας κώδικα XML',
	'ps-schema-description' => 'Σημασιολογικό σχήμα για σελίδες',
	'generatepages' => 'Παραγωγή σελίδων',
	'ps-generatepages-desc' => 'Παραγωγή των ακόλουθων σελίδων, βάσει του σημασιολογικού σχήματος αυτής της κατηγορίας:',
	'ps-generatepages-success' => 'Θα παραχθούν οι επιλεγμένες σελίδες.',
	'ps-generatepages-noschema' => 'Σφάλμα: Δεν έχει οριστεί σημασιολογικό σχήμα σελίδων για αυτήν την κατηγορία.',
	'ps-generatepages-editsummary' => 'Έγινε παραγωγή από ένα σημασιολογικό σχήμα για σελίδες',
	'ps-page-desc-cat-not-exist' => 'Αυτή η κατηγορία δεν έχει δημιουργηθεί ακόμα. Δημιουργία αυτής της κατηγορίας και του σημασιολογικού της σχήματος:',
	'ps-page-desc-ps-not-exist' => 'Η κατηγορία αυτή υπάρχει, αλλά δεν έχει σημασιολογικό σχήμα σελίδων. Δημιουργία σχήματος:',
	'ps-page-desc-edit-schema' => 'Επεξεργασία σημασιολογικού σχήματος σελίδων για αυτή την κατηγορία:',
	'ps-delimiter-label' => 'Διαχωριστικό για τις τιμές (η προεπιλογή είναι «,»):',
	'ps-multiple-temp-label' => 'Να επιτρέπονται πολλαπλά στιγμιότυπα αυτού του προτύπου',
	'ps-field-list-label' => 'Αυτό το πεδίο μπορεί να περιέχει μια λίστα τιμών',
	'ps-template' => 'Πρότυπο',
	'ps-add-template' => 'Προσθήκη προτύπου',
	'ps-remove-template' => 'Αφαίρεση προτύπου',
	'ps-field' => 'Πεδίο',
	'ps-namelabel' => 'Όνομα:',
	'ps-displaylabel' => 'Εμφανιζόμενη ετικέτα:',
	'ps-add-field' => 'Προσθήκη πεδίου',
	'ps-remove-field' => 'Αφαίρεση πεδίου',
	'ps-add-xml-label' => 'Πρόσθετος κώδικας XML:',
	'ps-optional-name' => 'Όνομα (αφήστε το κενό αν θέλετε να είναι ίδιο με το όνομα πεδίου):',
	'editschema' => 'Επεξεργασία σχήματος',
	'createschema' => 'Δημιουργία σχήματος',
	'right-generatepages' => 'Προβολή καρτέλας και σελίδας «Παραγωγή σελίδων»',
	'action-generatepages' => 'προβολή καρτέλας και σελίδας «Παραγωγή σελίδων»', # Fuzzy
);

/** Esperanto (Esperanto)
 * @author Yekrats
 */
$messages['eo'] = array(
	'ps-template' => 'Ŝablono',
	'ps-add-template' => 'Aldoni ŝablonon',
	'ps-remove-template' => 'Forigi ŝablonon',
	'ps-field' => 'Kampo',
	'ps-namelabel' => 'Nomo:',
	'ps-add-field' => 'Aldoni kampon',
	'ps-remove-field' => 'Forigi kampon',
);

/** Spanish (español)
 * @author Armando-Martin
 * @author Ciencia Al Poder
 * @author Fitoschido
 * @author Translationista
 */
$messages['es'] = array(
	'ps-desc' => 'Define la estrutura de datos de todas las páginas de una categoría mediante formato XML',
	'ps-schema-description' => 'Esquema de la página',
	'generatepages' => 'Generar las páginas',
	'ps-generatepages-desc' => 'Generar las siguientes páginas, según el esquema de esta categoría:',
	'ps-generatepages-success' => 'Las páginas seleccionadas van a ser generadas.',
	'ps-generatepages-noschema' => 'Erro: No hay ningún esquema de página definido para esta categoría.',
	'ps-generatepages-editsummary' => 'Generado a partir del esquema de página',
	'ps-page-desc-cat-not-exist' => 'Esta categoría aun no existe. Cree esta categoría y su esquema de página:',
	'ps-page-desc-ps-not-exist' => 'Esta categoría existe, pero no tiene un esquema de página. Cree el esquema:',
	'ps-page-desc-edit-schema' => 'Edite el esquema de página de esta categoría:',
	'ps-delimiter-label' => 'Delimitador para los valores (por defecto es ","):',
	'ps-multiple-temp-label' => 'Permitir varios ejemplos de esta plantilla',
	'ps-field-list-label' => 'Este campo puede contener una lista de valores',
	'ps-template' => 'Plantilla',
	'ps-add-template' => 'Agregar plantilla:',
	'ps-remove-template' => 'Eliminar plantilla',
	'ps-field' => 'Campo',
	'ps-namelabel' => 'Nombre:',
	'ps-displaylabel' => 'Mostrar etiqueta:',
	'ps-add-field' => 'Agregar campo',
	'ps-remove-field' => 'Eliminar campo',
	'ps-add-xml-label' => 'XML adicional:',
	'ps-optional-name' => 'Nombre (déjelo en blanco para definir el nombre del campo):',
	'editschema' => 'Editar el esquema',
	'createschema' => 'Crear el esquema',
	'right-generatepages' => 'Ver la pestaña y la página «{{int:generatepages}}»',
	'action-generatepages' => 'Ver la pestaña y la página "{{int:generatepages}}"',
);

/** Estonian (eesti)
 * @author Avjoska
 */
$messages['et'] = array(
	'ps-template' => 'Mall',
	'ps-add-template' => 'Lisa mall',
	'ps-field' => 'Väli',
	'ps-namelabel' => 'Nimi:',
	'ps-add-field' => 'Lisa väli',
	'ps-remove-field' => 'Eemalda väli',
);

/** Basque (euskara)
 * @author පසිඳු කාවින්ද
 */
$messages['eu'] = array(
	'ps-template' => 'Txantiloi',
	'ps-namelabel' => 'Izena:',
);

/** Persian (فارسی)
 * @author Armin1392
 * @author Mjbmr
 * @author Omidh
 * @author Reza1615
 */
$messages['fa'] = array(
	'ps-desc' => 'تعریف ساختار داده‌ها برای همهٔ صفحات در یک مقوله با استفاده از ایکس‌ام‌ال',
	'ps-schema-description' => 'طرح صفحه',
	'generatepages' => 'تولید صفحات',
	'ps-generatepages-desc' => 'تولید صفحات زیر، براساس این طرح کلی مقوله:',
	'ps-generatepages-success' => 'صفحات انتخاب شده تولید خواهند شد.',
	'ps-generatepages-noschema' => 'خطا: هیچ طرح صفحه‌ای برای این مقوله تعریف نشده‌است.',
	'ps-generatepages-editsummary' => 'از یک طرح صفحه تولید شده',
	'ps-page-desc-cat-not-exist' => 'این مقوله هنوز وجود ندارد. این مقوله را ایجاد کنید و این طرح صفحه است:',
	'ps-page-desc-ps-not-exist' => 'این مقوله وجود دارد، اما طرح صفحه ندارد. طرح ایجاد کنید:',
	'ps-page-desc-edit-schema' => 'ویرایش طرح صفحه برای این مقوله:',
	'ps-delimiter-label' => 'حائل برای مقادیر (پیش‌فرض "،" است):',
	'ps-multiple-temp-label' => 'اجازهٔ چند نمونه از این الگو',
	'ps-field-list-label' => 'این زمینه می‌تواند فهرستی از مقادیر را دریافت کند',
	'ps-template' => 'الگو',
	'ps-add-template' => 'افزودن الگو',
	'ps-remove-template' => 'حذف الگو',
	'ps-field' => 'زمینه',
	'ps-namelabel' => 'نام:',
	'ps-displaylabel' => 'برچسب نمایش:',
	'ps-add-field' => 'افزودن زمینه',
	'ps-remove-field' => 'حذف زمینه',
	'ps-add-xml-label' => 'ایکس‌ام‌ال اضافی:',
	'ps-optional-name' => 'نام (برای تنظیم نام زمینه، جای خالی را رها کنید):',
	'editschema' => 'ویرایش طرح',
	'createschema' => 'ایجاد طرح',
	'right-generatepages' => 'مشاهدهٔ صفحه و نوار "{{int:generatepages}}"',
	'action-generatepages' => 'مشاهدهٔ صفحه و نوار "{{int:generatepages}}"',
	'ps-add-section' => 'افزودن بخش',
	'ps-removepagesection' => 'حذف بخش',
	'ps-sectionname' => 'نام بخش:',
	'ps-sectionlevel' => 'سطح بخش:',
	'ps-section' => 'بخش',
	'ps-level' => 'سطح',
	'ps-otherparams' => 'پارامترهای دیگر',
	'ps-createpage-irregulartext' => 'صفحهٔ ویکی "$1" متن ویکی منظمی را دریافت نمی‌کند.',
	'ps-createpage-invalidtitle' => 'عنوان نادرست',
	'ps-createpage-notfound' => 'مقاله پیدا نشد',
	'ps-field-display-always' => 'نمایش همیشگی این زمینه',
	'ps-field-display-notempty' => 'اگر خالی نباشد نمایش دهد',
	'ps-field-display-hide' => 'نهفتن',
	'ps-field-namespace' => 'این زمینه همیشه مقادیری در فضای نام زیر خواهد‌ داشت:',
);

/** Finnish (suomi)
 * @author Beluga
 * @author Crt
 */
$messages['fi'] = array(
	'ps-desc' => 'Tukee mallineiden tietorakenteiden määrittelyä XML-merkkauskielen kautta.', # Fuzzy
	'ps-template' => 'Malline',
	'ps-add-template' => 'Lisää malline',
	'ps-remove-template' => 'Poista malline',
	'ps-field' => 'Kenttä',
	'ps-namelabel' => 'Nimi:',
	'ps-displaylabel' => 'Näyttönimi:',
	'ps-add-field' => 'Lisää kenttä',
	'ps-remove-field' => 'Poista kenttä',
);

/** French (français)
 * @author Gomoko
 * @author IAlex
 * @author PieRRoMaN
 * @author Sherbrooke
 * @author Wyz
 * @author Yann.fauche
 * @author Zebulon84
 */
$messages['fr'] = array(
	'ps-desc' => 'Définit la structure des données pour toutes les pages dans une catégorie en utilisant XML',
	'ps-schema-description' => 'Schéma de la page',
	'generatepages' => 'Générer les pages',
	'ps-generatepages-desc' => "Générer les pages suivantes, d'après le schéma de cette catégorie:",
	'ps-generatepages-success' => 'Les pages sélectionnées seront générés.',
	'ps-generatepages-noschema' => "Erreur: il n'y a pas de schéma de page défini pour cette catégorie",
	'ps-generatepages-editsummary' => 'Généré depuis le schéma de page',
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
	'ps-namelabel' => 'Nom :',
	'ps-displaylabel' => 'Afficher le libellé:',
	'ps-add-field' => 'Ajouter un champ',
	'ps-remove-field' => 'Supprimer un champ',
	'ps-add-xml-label' => 'XML supplémentaire:',
	'ps-optional-name' => 'Nom (laisser blanc pour mettre le nom du champ):',
	'editschema' => 'Modifier le schéma',
	'createschema' => 'Créer le schéma',
	'right-generatepages' => "Afficher l'onglet ou la page « {{int:generatepages}} »",
	'action-generatepages' => 'afficher la page ou l\'onglet "{{int:Generatepages}}"',
	'ps-add-section' => 'Ajouter une section',
	'ps-removepagesection' => 'Enlever une section',
	'ps-sectionname' => 'Nom de la section :',
	'ps-sectionlevel' => 'Niveau de section :',
	'ps-section' => 'Section',
	'ps-level' => 'Niveau',
	'ps-otherparams' => 'Autres paramètres',
	'ps-createpage-irregulartext' => 'La page wiki "$1" ne contient pas de texte valide.',
	'ps-createpage-invalidtitle' => 'Titre non valide',
	'ps-createpage-notfound' => 'Article non trouvé',
	'ps-field-display-always' => 'Toujours afficher ce champ',
	'ps-field-display-notempty' => "À afficher si le champ n'est pas vide",
	'ps-field-display-hide' => 'Cacher',
	'ps-field-namespace' => 'Ce champ aura toujours des valeurs dans l’espace de noms suivant :',
);

/** Franco-Provençal (arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'ps-desc' => 'Dèfenét la structura de les balyês por totes les pâges dens una catègorie en utilisent XML.',
	'ps-schema-description' => 'Plan de la pâge',
	'generatepages' => 'Fâre les pâges',
	'ps-generatepages-editsummary' => 'Fêt dês lo plan de pâge',
	'ps-template' => 'Modèlo',
	'ps-add-template' => 'Apondre un modèlo',
	'ps-remove-template' => 'Enlevar un modèlo',
	'ps-field' => 'Champ',
	'ps-namelabel' => 'Nom :',
	'ps-displaylabel' => 'Ètiquèta por la visualisacion :',
	'ps-add-field' => 'Apondre un champ',
	'ps-remove-field' => 'Enlevar un champ',
	'ps-add-xml-label' => 'XML de ples :',
	'editschema' => 'Changiér lo plan',
	'createschema' => 'Fâre lo plan',
);

/** Irish (Gaeilge)
 * @author පසිඳු කාවින්ද
 */
$messages['ga'] = array(
	'ps-namelabel' => 'Ainm:',
);

/** Galician (galego)
 * @author MetalBrasil
 * @author Toliño
 */
$messages['gl'] = array(
	'ps-desc' => 'Define a estrutura de datos de todas as páxinas dunha categoría mediante formato XML',
	'ps-schema-description' => 'Esquema da páxina',
	'generatepages' => 'Xerar as páxinas',
	'ps-generatepages-desc' => 'Xerar as seguintes páxinas, segundo o esquema desta categoría:',
	'ps-generatepages-success' => 'As páxinas seleccionadas van ser xeradas.',
	'ps-generatepages-noschema' => 'Erro: Non hai ningún esquema de páxina definido para esta categoría.',
	'ps-generatepages-editsummary' => 'Xerado a partir do esquema de páxina',
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
	'ps-namelabel' => 'Nome:',
	'ps-displaylabel' => 'Mostrar a etiqueta:',
	'ps-add-field' => 'Engadir un campo',
	'ps-remove-field' => 'Eliminar un campo',
	'ps-add-xml-label' => 'XML adicional:',
	'ps-optional-name' => 'Nome (déixeo en branco para definir o nome do campo):',
	'editschema' => 'Editar o esquema',
	'createschema' => 'Crear o esquema',
	'right-generatepages' => 'Ollar a lapela e a páxina "{{int:generatepages}}"',
	'action-generatepages' => 'ollar a lapela e a páxina "{{int:Generatepages}}"',
	'ps-add-section' => 'Engadir unha sección',
	'ps-removepagesection' => 'Eliminar a sección',
	'ps-sectionname' => 'Nome da sección:',
	'ps-sectionlevel' => 'Nivel de sección:',
	'ps-section' => 'Sección',
	'ps-level' => 'Nivel',
	'ps-otherparams' => 'Outros parámetros',
	'ps-createpage-irregulartext' => 'A páxina wiki "$1" non contén texto wiki habitual.',
	'ps-createpage-invalidtitle' => 'Título non válido',
	'ps-createpage-notfound' => 'Non se atopou o artigo',
	'ps-field-display-always' => 'Mostrar sempre este campo',
	'ps-field-display-notempty' => 'Mostrar se non está baleiro',
	'ps-field-display-hide' => 'Agochar',
);

/** Swiss German (Alemannisch)
 * @author Als-Chlämens
 * @author Als-Holder
 */
$messages['gsw'] = array(
	'ps-desc' => 'Definiert d Datestruktur für alli Syte inere Kategori, wo XML bruuche',
	'ps-schema-description' => 'Syteschema:',
	'generatepages' => 'Syte generiere',
	'ps-generatepages-desc' => 'Die Syte, wo folge, uff Basis vum Schema vo dere Kategori generiere',
	'ps-generatepages-success' => 'Die Syte, wo ussgwäält sin, werde generiert.',
	'ps-generatepages-noschema' => 'Fääler: Für die Kategori isch kei Schema definiert.',
	'ps-generatepages-editsummary' => 'Uff Basis vum Schema, wo folgt, generiert',
	'ps-page-desc-cat-not-exist' => "Die Kategorie git's no nit. Die Kategori un ihr Schema erstelle:",
	'ps-template' => 'Vorlag',
	'ps-add-template' => 'Vorlag zuefiege',
	'ps-remove-template' => 'Vorlag usenee',
	'ps-field' => 'Fäld',
	'ps-namelabel' => 'Name:',
	'ps-add-field' => 'Fieg Fäld yy',
	'ps-remove-field' => 'Fäld uusenee',
	'ps-add-xml-label' => 'Zuesätzlichs XML:',
);

/** Hebrew (עברית)
 * @author Amire80
 * @author Inkbug
 * @author YaronSh
 * @author חיים
 */
$messages['he'] = array(
	'ps-desc' => 'הגדרת מבני נתונים לכל הדפים בקטגוריה באמצעות XML',
	'generatepages' => 'יצירת דפים',
	'ps-template' => 'תבנית',
	'ps-createpage-invalidtitle' => 'כותרת בלתי תקינה',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ps-desc' => 'Definuje datowu strukturu za wšě strony w kategoriji z pomocu XML',
	'ps-schema-description' => 'Šema strony',
	'generatepages' => 'Strony wutworić',
	'ps-generatepages-desc' => 'Slědowace strony na zakładźe šemy tuteje kategorije wutworić:',
	'ps-generatepages-success' => 'Wubrane strony so wutworja.',
	'ps-generatepages-noschema' => 'Zmylk: Njeje žana šema strony za tutu kategoriju definowana.',
	'ps-generatepages-editsummary' => 'Ze šemy strony wutworjeny',
	'ps-page-desc-cat-not-exist' => 'Tuta kategorija hišće njeeksistuje. Wutwor tutu kategoriju a jeje šemu strony:',
	'ps-page-desc-ps-not-exist' => 'Tuta kategorija eksistuje, ale nima šemu strony. Wutwor šemu:',
	'ps-page-desc-edit-schema' => 'Wobdźěł šemu strony za tutu kategoriju:',
	'ps-delimiter-label' => 'Dźělatko za hódnoty (standard je "2,"):',
	'ps-multiple-temp-label' => 'Wjacore instancy tuteje předłohi zmóžnić',
	'ps-field-list-label' => 'Tute polo móže lisćinu hódnotow wobsahować',
	'ps-template' => 'Předłoha',
	'ps-add-template' => 'Předłohu přidać',
	'ps-remove-template' => 'Předłohu wotstronić',
	'ps-field' => 'Polo',
	'ps-namelabel' => 'Mjeno:',
	'ps-displaylabel' => 'Polowe mjeno, kotrež ma so pokazać:',
	'ps-add-field' => 'Polo přidać',
	'ps-remove-field' => 'Polo wotstronić',
	'ps-add-xml-label' => 'Přidatny XML:',
	'ps-optional-name' => 'Mjeno (prózdne wostajić, zo by pólne mjeno wužił)',
	'editschema' => 'Šemu wobdźěłać',
	'createschema' => 'Šemu wutworić',
	'right-generatepages' => 'Rajtark a stronu "{{int:generatepages}}" pokazać',
	'action-generatepages' => 'Rajtark a stronu "{{int:Generatepages}}"  pokazać',
);

/** Hungarian (magyar)
 * @author Dani
 * @author Dj
 */
$messages['hu'] = array(
	'ps-desc' => 'Az adott kategóriába tartozó valamennyi lap adat struktúráját definiálja XML segítségével',
	'ps-schema-description' => 'Lapséma',
	'generatepages' => 'Oldalak generálása',
	'ps-generatepages-desc' => 'Az alábbi lapok generálása a kategória séma alapján:',
	'ps-generatepages-success' => 'A kiválasztott lapok lesznek legenerálva.',
	'ps-generatepages-noschema' => 'Hiba: nincs lapséma ehhez a kategóriához.',
	'ps-generatepages-editsummary' => 'Lapsémából generálva',
	'ps-page-desc-cat-not-exist' => 'Ez a kategória még nem létezik. Hozd létre ezt a kategóriát és a lapsémáját:',
	'ps-page-desc-ps-not-exist' => 'Ez a séma létezik, de nincs hozzá lapséma. Hozzál létre sémát:',
	'ps-page-desc-edit-schema' => 'Lapséma létrehozása ehhez a kategóriához:',
	'ps-delimiter-label' => 'Értékek elválasztója (alapértelmezett ","):',
	'ps-multiple-temp-label' => 'Több példány engedélyezése ehhez a sablonhoz',
	'ps-field-list-label' => 'Ez a mező értékek listáját tartalmazhatja',
	'ps-template' => 'Sablon',
	'ps-add-template' => 'Sablon hozzáadása',
	'ps-remove-template' => 'Sablon eltávolítása',
	'ps-field' => 'Mező',
	'ps-namelabel' => 'Név:',
	'ps-displaylabel' => 'Megjelenített szöveg:',
	'ps-add-field' => 'Mező hozzáadása',
	'ps-remove-field' => 'Mező eltávolítása',
	'ps-add-xml-label' => 'További XML:',
	'ps-optional-name' => 'Név (hagyd üresen, ha a mező nevére akarod beállítani):',
	'editschema' => 'Séma módosítása',
	'createschema' => 'Séma létrehozása',
);

/** Interlingua (interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'ps-desc' => 'Defini le structura de datos pro tote le paginas in un categoria usante XML',
	'ps-schema-description' => 'Schema de pagina',
	'generatepages' => 'Generar paginas',
	'ps-generatepages-desc' => 'Generar le sequente paginas a base del schema de iste categoria:',
	'ps-generatepages-success' => 'Le paginas seligite essera generate.',
	'ps-generatepages-noschema' => 'Error: Il non ha un schema de pagina definite pro iste categoria.',
	'ps-generatepages-editsummary' => 'Generate ab un schema de pagina',
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
	'ps-namelabel' => 'Nomine:',
	'ps-displaylabel' => 'Etiquetta pro monstrar:',
	'ps-add-field' => 'Adder campo',
	'ps-remove-field' => 'Remover campo',
	'ps-add-xml-label' => 'Additional XML:',
	'ps-optional-name' => 'Nomine (lassar vacue pro definir como le nomine del campo):',
	'editschema' => 'Modificar schema',
	'createschema' => 'Crear schema',
	'right-generatepages' => 'Vider le scheda e pagina "{{int:generatepages}}"',
	'action-generatepages' => 'vider le scheda e pagina "{{int:Generatepages}}"',
);

/** Indonesian (Bahasa Indonesia)
 * @author IvanLanin
 * @author පසිඳු කාවින්ද
 */
$messages['id'] = array(
	'ps-desc' => 'Mendukung templat untuk dapat mendefinisikan struktur data mereka melalui markah XML', # Fuzzy
	'ps-template' => 'Templat',
	'ps-namelabel' => 'Nama:',
);

/** Igbo (Igbo)
 * @author Ukabia
 */
$messages['ig'] = array(
	'ps-desc' => 'Në nyé ike maka mkpurụ ihü, në nyé úchè maka ázú omárí ha nke shi édé XML', # Fuzzy
);

/** Italian (italiano)
 * @author Beta16
 * @author Gianfranco
 */
$messages['it'] = array(
	'ps-desc' => 'Definisce la struttura di dati per tutte le pagine in una categoria utilizzando XML',
	'ps-schema-description' => 'Schema pagina',
	'generatepages' => 'Genera pagine',
	'ps-generatepages-desc' => 'Genera le seguenti pagine, basate sullo schema di questa categoria:',
	'ps-generatepages-success' => 'Le pagine selezionate verranno generate.',
	'ps-generatepages-noschema' => "Errore: non non c'è nessun schema di pagina definito per questa categoria.",
	'ps-generatepages-editsummary' => 'Generata da uno schema di pagina',
	'ps-page-desc-cat-not-exist' => 'Questa categoria non esiste ancora. Crea questa categoria ed il relativo schema di pagina:',
	'ps-page-desc-ps-not-exist' => 'Questa categoria esiste, ma non ha uno schema di pagina. Crea uno schema:',
	'ps-page-desc-edit-schema' => 'Modifica lo schema di pagina per questa categoria:',
	'ps-delimiter-label' => 'Delimitatore per valori (predefinito è ","):',
	'ps-multiple-temp-label' => 'Consentire più istanze di questo template',
	'ps-field-list-label' => 'Questo campo può contenere un elenco di valori',
	'ps-template' => 'Template',
	'ps-add-template' => 'Aggiungi template',
	'ps-remove-template' => 'Rimuovi template',
	'ps-field' => 'Campo',
	'ps-namelabel' => 'Nome:',
	'ps-displaylabel' => 'Etichetta da mostrare:',
	'ps-add-field' => 'Aggiungi campo',
	'ps-remove-field' => 'Rimuovi campo',
	'ps-add-xml-label' => 'XML addizionale:',
	'ps-optional-name' => 'Nome (lascia vuoto per impostare come il nome del campo):',
	'editschema' => 'Modifica schema',
	'createschema' => 'Creare schema',
	'right-generatepages' => 'Visualizza la scheda e la pagina "{{int:generatepages}}"',
	'action-generatepages' => 'vedere la scheda e la pagina "{{int:Generatepages}}"',
	'ps-add-section' => 'Aggiungi sezione',
	'ps-removepagesection' => 'Rimuovi sezione',
	'ps-sectionname' => 'Nome della sezione:',
	'ps-sectionlevel' => 'Livello della sezione:',
	'ps-section' => 'Sezione',
	'ps-level' => 'Livello',
	'ps-otherparams' => 'Altri parametri',
	'ps-createpage-invalidtitle' => 'Titolo non valido',
	'ps-createpage-notfound' => 'Voce non trovata',
	'ps-field-display-always' => 'Mostra sempre questo campo',
	'ps-field-display-notempty' => 'Mostra se non vuoto',
	'ps-field-display-hide' => 'Nascondi',
);

/** Japanese (日本語)
 * @author Fryed-peach
 * @author Schu
 * @author Shirayuki
 */
$messages['ja'] = array(
	'ps-desc' => 'XML を使用して、カテゴリ内のすべてのページのデータ構造を定義する',
	'ps-schema-description' => 'ページのスキーマ',
	'generatepages' => 'ページを生成',
	'ps-generatepages-desc' => 'このカテゴリのスキーマに基づいて、次のページを生成',
	'ps-generatepages-success' => '選択したページが生成されます。',
	'ps-generatepages-noschema' => 'エラー: このカテゴリに定義されているページのスキーマはありません。',
	'ps-generatepages-editsummary' => 'ページのスキーマにより生成',
	'ps-page-desc-cat-not-exist' => 'このカテゴリはまだ存在しません。このカテゴリとそのページのスキーマを作成します。',
	'ps-page-desc-ps-not-exist' => 'このカテゴリは存在しますが、ページのスキーマを持っていません。スキーマを作成:',
	'ps-page-desc-edit-schema' => 'このカテゴリのページのスキーマを編集:',
	'ps-delimiter-label' => '値の区切り文字 (既定は「,」):',
	'ps-multiple-temp-label' => 'このテンプレートの複数のインスタンスを許可',
	'ps-field-list-label' => 'このフィールドは、値の列挙を保持できます',
	'ps-template' => 'テンプレート',
	'ps-add-template' => 'テンプレートを追加',
	'ps-remove-template' => 'テンプレートを除去',
	'ps-field' => 'フィールド',
	'ps-namelabel' => '名前:',
	'ps-displaylabel' => '表示ラベル:',
	'ps-add-field' => 'フィールドを追加',
	'ps-remove-field' => 'フィールドを除去',
	'ps-add-xml-label' => '追加の XML:',
	'ps-optional-name' => '名前 (空欄の場合はフィールド名を使用):',
	'editschema' => 'スキーマの編集',
	'createschema' => 'スキーマ作成',
	'right-generatepages' => '「{{int:generatepages}}」タブとページを閲覧',
	'action-generatepages' => '「{{int:generatepages}}」タブとページの閲覧',
	'ps-add-section' => '節を追加',
	'ps-removepagesection' => '節を除去',
	'ps-sectionname' => '節の名前:',
	'ps-sectionlevel' => '節のレベル:',
	'ps-section' => '節',
	'ps-level' => 'レベル',
	'ps-otherparams' => 'その他のパラメーター',
	'ps-createpage-irregulartext' => 'ウィキページ「$1」は通常のウィキテキストを保持していません。',
	'ps-createpage-invalidtitle' => '無効なページ名',
	'ps-createpage-notfound' => '記事が見つかりません',
	'ps-field-display-always' => 'このフィールドを常に表示',
	'ps-field-display-notempty' => '空ではない場合表示',
	'ps-field-display-hide' => '非表示',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'ps-schema-description' => 'გვერდის სქემა',
	'generatepages' => 'გვერდების შექმნა',
	'ps-generatepages-success' => 'არჩეული გვერდები შეიქმნება.',
	'ps-delimiter-label' => 'მნიშვნელობის გამყოფი (სტანდარტული არის „,“):',
	'ps-template' => 'თარგი',
	'ps-add-template' => 'თარგის დამატება',
	'ps-remove-template' => 'თარგის წაშლა',
	'ps-field' => 'ველი',
	'ps-namelabel' => 'სახელი:',
	'ps-displaylabel' => 'სახელი ეკრანზე:',
	'ps-add-field' => 'ველის დამატება',
	'ps-remove-field' => 'ველის წაშლა',
	'ps-add-xml-label' => 'დამატებითი XML:',
	'editschema' => 'სქემის რედაქტირება',
	'createschema' => 'სქემის შექმნა',
);

/** Kazakh (Cyrillic script) (қазақша (кирил)‎)
 * @author Arystanbek
 */
$messages['kk-cyrl'] = array(
	'ps-createpage-notfound' => 'Мақала табылмады',
	'ps-field-display-always' => 'Кейде бұл жолақты көрсету',
	'ps-field-display-hide' => 'Жасыру',
);

/** Korean (한국어)
 * @author Clockoon
 * @author Priviet
 * @author 아라
 */
$messages['ko'] = array(
	'ps-desc' => 'XML을 사용하여 분류에 모든 문서에 대한 데이터 구조를 정의',
	'ps-schema-description' => '문서 스키마',
	'generatepages' => '문서 생성',
	'ps-generatepages-desc' => '이 분류의 스키마를 기반으로 다음 문서를 생성합니다:',
	'ps-generatepages-success' => '선택한 문서를 생성합니다.',
	'ps-generatepages-noschema' => '오류: 이 분류에 정의한 문서 스키마가 없습니다.',
	'ps-generatepages-editsummary' => '문서 스키마에서 생성함',
	'ps-page-desc-cat-not-exist' => '이 분류가 존재하지 않습니다. 이 분류와 해당 문서 스키마를 만듭니다:',
	'ps-page-desc-ps-not-exist' => '이 분류는 존재하지만 문서 스케마를 가지고 있지 않습니다. 스키마를 만듭니다:',
	'ps-page-desc-edit-schema' => '이 분류에 대한 문서 스키마를 편집합니다:',
	'ps-delimiter-label' => '값에 대한 구분자 (기본값은 ","):',
	'ps-multiple-temp-label' => '이 분류의 여러 인스턴스 허용',
	'ps-field-list-label' => '이 필드는 값의 목록을 보관할 수 있습니다',
	'ps-template' => '틀',
	'ps-add-template' => '틀 추가',
	'ps-remove-template' => '틀 제거',
	'ps-field' => '필드',
	'ps-namelabel' => '이름:',
	'ps-displaylabel' => '보여줄 레이블:',
	'ps-add-field' => '필드 추가',
	'ps-remove-field' => '필드 제거',
	'ps-add-xml-label' => '추가적인 XML:',
	'ps-optional-name' => '이름 (비어 있으면 필드 이름 사용):',
	'editschema' => '스키마 편집',
	'createschema' => '스키마 만들기',
	'right-generatepages' => '"{{int:Generatepages}}" 탭과 문서 보기',
	'action-generatepages' => '"{{int:Generatepages}}" 탭과 문서 보기',
	'ps-add-section' => '문단 추가',
	'ps-removepagesection' => '문단 제거',
	'ps-sectionname' => '문단 이름:',
	'ps-sectionlevel' => '문단 수준:',
	'ps-section' => '문단',
	'ps-level' => '수준',
	'ps-otherparams' => '다른 매개변수',
	'ps-createpage-irregulartext' => '위키 페이지 "$1"은(는) 위키 텍스트를 포함하고 있지 않습니다.',
	'ps-createpage-invalidtitle' => '제목이 잘못되었습니다.',
	'ps-createpage-notfound' => '문서를 찾을 수 없음',
	'ps-field-display-always' => '이 필드를 항상 표시',
	'ps-field-display-notempty' => '비어 있지 않으면 보기',
	'ps-field-display-hide' => '숨기기',
	'ps-field-namespace' => '이 필드는 항상 다음 이름공간을 값으로 가져야 합니다:',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'ps-desc' => 'Jitt de Dateschtruktur vun alle SIgge en en Saachjropp en enem <i lang="en">XML</i>-Fommaad aan.',
	'ps-schema-description' => 'Et Sigge-Schema',
	'generatepages' => 'Sigge automattesch aanlääje',
	'ps-generatepages-desc' => 'Donn de Sigge en dä Leß heh automattesch aanlääje, noh dämm XML-Schema för di Saachjropp:',
	'ps-generatepages-success' => 'e ußjewähltei Sigge wääde automattesch aanjelaat.',
	'ps-generatepages-noschema' => 'Fähler: Mer han kei XML-Schema för di Saachjropp.',
	'ps-generatepages-editsummary' => 'Övver e Scheema för en Sigg opjemaat',
	'ps-page-desc-cat-not-exist' => 'Di Saachjropp jidd_et noch nit. Donn di Jropp aanlääje un e Schema för dä ier Siggg:',
	'ps-page-desc-ps-not-exist' => 'Heh di Saachjropp jidd_et, ävver se hät kei XML-Schema. Donn ein aanlääje:',
	'ps-page-desc-edit-schema' => 'Donn dat XML-Schema för di Saachjropp ändere:',
	'ps-delimiter-label' => 'Et Drännzeische för Wääte. Et Komma „,“ es der Schtandadd:',
	'ps-multiple-temp-label' => 'Donn di Schabloon för mieh wi eine beschtemmpte Jebru frei jävve',
	'ps-field-list-label' => 'En däm Feld kann en Leß met Wääte shtonn',
	'ps-template' => 'Schabloon',
	'ps-add-template' => 'Donn en Schabloon dobei',
	'ps-remove-template' => 'Maach di Schabloon fott',
	'ps-field' => 'Väld',
	'ps-namelabel' => 'Der Naame:',
	'ps-displaylabel' => 'För Aanzezeije, de Opschreff för dat Feld:',
	'ps-add-field' => 'Donn e Feld dobei',
	'ps-remove-field' => 'Nemm dat  Feld fott',
	'ps-add-xml-label' => 'Zohsäzlesh XML:',
	'ps-optional-name' => 'Dä Name — kam_mer läddesch lohße, dann ess_et automattesch dä Name vun däm Feld:',
	'editschema' => 'Et Schema ändere',
	'createschema' => 'E XML-Schema aanlääje',
	'right-generatepages' => 'Dä Lengk „{{int:generatepages}}“ un di Sigg sin dörve',
	'action-generatepages' => 'der Lengk „{{int:generatepages}}“ un di Sigg beloore dörve',
);

/** Kurdish (Latin script) (Kurdî (latînî)‎)
 * @author George Animal
 */
$messages['ku-latn'] = array(
	'ps-template' => 'Şablon',
	'ps-namelabel' => 'Nav:',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 * @author Soued031
 */
$messages['lb'] = array(
	'ps-desc' => "Definéiert d'Date-Struktur per XML fir all Säiten an enger Kategorie",
	'ps-schema-description' => 'Schema vun der Säit',
	'generatepages' => 'Säite generéieren',
	'ps-generatepages-desc' => 'Dës Säiten op der Basis vum Schema vun dëser Kategorie generéieren:',
	'ps-generatepages-success' => 'Déi erausgesichte Säite gi generéiert.',
	'ps-generatepages-noschema' => 'Feeler: et ass kee Säite-Schema fir dës Kategorie definéiert',
	'ps-generatepages-editsummary' => 'Generéiert op Basis vum Säite-Schema',
	'ps-page-desc-cat-not-exist' => 'Dës Kategorie gëtt et nach net. Leet dës Kategorie an hire Säite-Schema un:',
	'ps-page-desc-ps-not-exist' => 'Dës Kategorie gëtt et, awer si huet nach kee Säite-Schema. Leet de Schema un:',
	'ps-page-desc-edit-schema' => 'De Säite-Schema fir dës Kategorie änneren:',
	'ps-delimiter-label' => 'Treenzeechen tëscht de Wäerter (standard ass ","):',
	'ps-multiple-temp-label' => 'Méi Instanze vun dësem Schema zouloossen',
	'ps-field-list-label' => 'An dësem Feld kann eng Lëscht vu Wäerter stoen',
	'ps-template' => 'Schabloun',
	'ps-add-template' => 'Schabloun derbäisetzen',
	'ps-remove-template' => 'Schablon ewechhuelen',
	'ps-field' => 'Feld',
	'ps-namelabel' => 'Numm:',
	'ps-displaylabel' => 'Etikett weisen:',
	'ps-add-field' => 'Feld derbäisetzen',
	'ps-remove-field' => 'Feld ewechhuelen',
	'ps-add-xml-label' => 'Zousätzlechen XML:',
	'ps-optional-name' => 'Numm (eidel loosse fir den Numm vum Feld ze benotzen):',
	'editschema' => 'Schema änneren',
	'createschema' => 'Schema uleeën',
	'right-generatepages' => 'Den Onglet "{{int:generatepages}}" an d\'Säit weisen',
	'action-generatepages' => 'den Onglet "{{int:Generatepages}}" an d\'Säit gesinn',
	'ps-add-section' => 'Abschnitt derbäisetzen',
	'ps-removepagesection' => 'Abschnitt ewechhuelen',
	'ps-sectionname' => 'Numm vum Abschnitt:',
	'ps-sectionlevel' => 'Niveau vum Abschnitt:',
	'ps-section' => 'Abschnitt',
	'ps-level' => 'Niveau',
	'ps-otherparams' => 'Aner Parameter',
	'ps-createpage-irregulartext' => 'Op der Wikisäit "$1" ass kee reguläre Wikitext.',
	'ps-createpage-invalidtitle' => 'Net valabelen Titel',
	'ps-createpage-notfound' => 'Artikel net fonnt',
	'ps-field-display-always' => 'Dëst Feld ëmmer weisen',
	'ps-field-display-notempty' => 'Weise wann net eidel',
	'ps-field-display-hide' => 'Verstoppen',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'ps-desc' => 'Ја определува податочната структура на сите страници во една категорија користејќи XML',
	'ps-schema-description' => 'Шемата на страници',
	'generatepages' => 'Создај страници',
	'ps-generatepages-desc' => 'Создај ги следниве страници врз основа на шемата на категоријата:',
	'ps-generatepages-success' => 'Избраните страници ќе бидат создадени.',
	'ps-generatepages-noschema' => 'Грешка: оваа категорија нема определена шема на страници',
	'ps-generatepages-editsummary' => 'Создадено од шемата на страницата',
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
	'ps-namelabel' => 'Име:',
	'ps-displaylabel' => 'Натпис за приказ:',
	'ps-add-field' => 'Додај поле',
	'ps-remove-field' => 'Отстрани поле',
	'ps-add-xml-label' => 'Дополнителен XML:',
	'ps-optional-name' => 'Име (оставете празно за да биде како името на полето):',
	'editschema' => 'Уреди шема',
	'createschema' => 'Создај шема',
	'right-generatepages' => 'Достапност на јазичето „{{int:generatepages}}“ и неговата страница',
	'action-generatepages' => 'приказ на јазичето „{{int:Generatepages}}“ и неговата страница',
	'ps-add-section' => 'Додај поднаслов',
	'ps-removepagesection' => 'Отстрани поднаслов',
	'ps-sectionname' => 'Назив на поднасловот:',
	'ps-sectionlevel' => 'Ниво на поднасловот:',
	'ps-section' => 'Поднаслов',
	'ps-level' => 'Ниво',
	'ps-otherparams' => 'Други параметри',
	'ps-createpage-irregulartext' => 'Викистраницата „$1“ нема обичен викитекст.',
	'ps-createpage-invalidtitle' => 'Неважечки наслов',
	'ps-createpage-notfound' => 'Не ја пронајдов статијата',
	'ps-field-display-always' => 'Секогаш прикажувај го полево',
	'ps-field-display-notempty' => 'Прикажувај ако не е празно',
	'ps-field-display-hide' => 'Скриј',
	'ps-field-namespace' => 'Ова поле секогаш ќе има вредности во следниов именски простор:',
);

/** Malayalam (മലയാളം)
 * @author Santhosh.thottingal
 */
$messages['ml'] = array(
	'ps-createpage-invalidtitle' => 'അസാധുവായ തലക്കെട്ട്',
	'ps-createpage-notfound' => 'ലേഖനം കണ്ടെത്താൻ കഴിഞ്ഞില്ല',
	'ps-field-display-notempty' => 'കാലിയല്ലെങ്കിൽ കാണിയ്ക്കുക',
	'ps-field-display-hide' => 'മറയ്ക്കുക',
);

/** Marathi (मराठी)
 * @author V.narsikar
 */
$messages['mr'] = array(
	'ps-add-section' => 'विभाग जोडा',
	'ps-removepagesection' => 'विभाग हटवा',
	'ps-sectionname' => 'विभागाचे नाव:',
	'ps-sectionlevel' => 'विभाग स्तर:',
	'ps-section' => 'विभाग',
	'ps-level' => 'पातळी',
	'ps-otherparams' => 'ईतर प्राचले',
);

/** Maltese (Malti)
 * @author Chrisportelli
 */
$messages['mt'] = array(
	'ps-template' => 'Mudell',
	'ps-add-template' => 'Żid mudell',
	'ps-remove-template' => 'Ħassar mudell',
	'ps-field' => 'Qasam',
	'ps-namelabel' => 'Isem:',
	'ps-add-field' => 'Żid qasam',
);

/** Norwegian Bokmål (norsk bokmål)
 * @author Nghtwlkr
 */
$messages['nb'] = array(
	'ps-desc' => 'Støtter maler som definerer datastrukturen sin gjennom XML-markering', # Fuzzy
);

/** Low German (Plattdüütsch)
 * @author Joachim Mos
 */
$messages['nds'] = array(
	'ps-namelabel' => 'Naam:',
);

/** Dutch (Nederlands)
 * @author JurgenNL
 * @author SPQRobin
 * @author Siebrand
 * @author Sjoerddebruin
 */
$messages['nl'] = array(
	'ps-desc' => "Bepaalt de gegevensstructuur van alle pagina's in een categorie via XML",
	'ps-schema-description' => 'Paginaschema',
	'generatepages' => "Pagina's aanmaken",
	'ps-generatepages-desc' => "Maak de volgende pagina's aan, gebaseerd op dit categorieschema:",
	'ps-generatepages-success' => "De geselecteerde pagina's worden aangemaakt.",
	'ps-generatepages-noschema' => 'Fout: Er is geen paginaschema voor deze categorie.',
	'ps-generatepages-editsummary' => 'Aangemaakt vanuit een paginaschema',
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
	'ps-namelabel' => 'Naam:',
	'ps-displaylabel' => 'Label weergeven:',
	'ps-add-field' => 'Veld toevoegen',
	'ps-remove-field' => 'Veld verwijderen',
	'ps-add-xml-label' => 'Extra XML:',
	'ps-optional-name' => 'Naam (laat leeg om in te stellen op de veldnaam):',
	'editschema' => 'Schema bewerken',
	'createschema' => 'Schema aanmaken',
	'right-generatepages' => 'Mag het tabblad en de pagina "{{int:generatepages}}" zien',
	'action-generatepages' => 'het tabblad en de pagina "{{int:Generatepages}}" te zien',
	'ps-add-section' => 'Sectie toevoegen',
	'ps-removepagesection' => 'Sectie verwijderen',
	'ps-sectionname' => 'Sectienaam:',
	'ps-sectionlevel' => 'Sectieniveau:',
	'ps-section' => 'Sectie',
	'ps-level' => 'Niveau',
	'ps-otherparams' => 'Andere parameters',
	'ps-createpage-invalidtitle' => 'Ongeldige titel',
	'ps-createpage-notfound' => 'Artikel niet gevonden',
	'ps-field-display-always' => 'Dit veld altijd weergeven',
	'ps-field-display-notempty' => 'Weergeven indien niet leeg',
	'ps-field-display-hide' => 'Verbergen',
);

/** Norwegian Nynorsk (norsk nynorsk)
 * @author Harald Khan
 */
$messages['nn'] = array(
	'ps-desc' => 'Støttar malar som definerer datastrukturen sin gjennom XML-markering.', # Fuzzy
);

/** Occitan (occitan)
 * @author Cedric31
 */
$messages['oc'] = array(
	'ps-desc' => 'Supòrta los modèls en definissent lor estructura de donadas via de balisas XML', # Fuzzy
	'ps-add-section' => 'Apondre una seccion',
	'ps-removepagesection' => 'Levar una seccion',
	'ps-sectionname' => 'Nom de la seccion :',
	'ps-sectionlevel' => 'Nivèl de seccion :',
	'ps-section' => 'Seccion',
	'ps-level' => 'Nivèl',
	'ps-otherparams' => 'Autres paramètres',
);

/** Pampanga (Kapampangan)
 * @author Val2397
 */
$messages['pam'] = array(
	'generatepages' => 'Gawan la reng bulung',
	'ps-template' => 'Ulma (Template)',
	'ps-add-template' => 'Magdagdag ulma',
	'ps-remove-template' => 'Ilako ya ing ulma',
	'ps-namelabel' => 'Lagiu',
);

/** Polish (polski)
 * @author BeginaFelicysym
 * @author Chrumps
 * @author Sp5uhe
 * @author Woytecr
 */
$messages['pl'] = array(
	'ps-desc' => 'Definiuje strukturę danych dla wszystkich stron w kategorii z wykorzystaniem XML',
	'ps-schema-description' => 'Schemat stron',
	'generatepages' => 'Wygeneruj strony',
	'ps-generatepages-desc' => 'Generuj następujące strony na podstawie schematu tej kategorii:',
	'ps-generatepages-success' => 'Zostaną wygenerowane wybrane strony.',
	'ps-generatepages-noschema' => 'Błąd: Nie zdefiniowano schematu strony dla tej kategorii.',
	'ps-generatepages-editsummary' => 'Wygenerowane na podstawie schematu strony',
	'ps-page-desc-cat-not-exist' => 'Ta kategoria jeszcze nie istnieje. Utwórz tą kategorię i jej schemat stron:',
	'ps-page-desc-ps-not-exist' => 'Ta kategoria istnieje, ale nie posiada schematu strony. Utwórz schemat:',
	'ps-page-desc-edit-schema' => 'Edytuj schemat stron dla tej kategorii:',
	'ps-delimiter-label' => 'Separator wartości (domyślnie ","):',
	'ps-multiple-temp-label' => 'Zezwalaj na wiele wystąpień tego szablonu',
	'ps-field-list-label' => 'To pole może zawierać listę wartości',
	'ps-template' => 'Szablon',
	'ps-add-template' => 'Dodaj szablon',
	'ps-remove-template' => 'Usuń szablon',
	'ps-field' => 'Pole',
	'ps-namelabel' => 'Nazwa',
	'ps-displaylabel' => 'Wyświetlana etykieta',
	'ps-add-field' => 'Dodaj pole',
	'ps-remove-field' => 'Usuń pole',
	'ps-add-xml-label' => 'Dodatkowy XML:',
	'ps-optional-name' => 'Nazwa (pozostaw puste aby ustawić nazwę pola):',
	'editschema' => 'Edytuj schemat',
	'createschema' => 'Utwórz schemat',
	'right-generatepages' => 'Wyświetlanie karty i strony "Generuj strony"', # Fuzzy
	'action-generatepages' => 'wyświetl kartę i stronę "{{int:Generatepages}}"',
	'ps-add-section' => 'Dodaj sekcję',
	'ps-removepagesection' => 'Usuń sekcję',
	'ps-sectionname' => 'Nazwa sekcji:',
	'ps-sectionlevel' => 'Poziom sekcji:',
	'ps-section' => 'Sekcja',
	'ps-level' => 'Poziom',
	'ps-otherparams' => 'Inne parametry',
	'ps-createpage-invalidtitle' => 'Nieprawidłowy tytuł',
	'ps-createpage-notfound' => 'Nie znaleziono artykułu',
	'ps-field-display-always' => 'Zawsze pokazuj to pole',
	'ps-field-display-hide' => 'Ukryj',
);

/** Piedmontese (Piemontèis)
 * @author Borichèt
 * @author Dragonòt
 */
$messages['pms'] = array(
	'ps-desc' => 'A definiss la strutura dij dat për tute le pàgine ant na categorìa an dovrand XML',
	'ps-schema-description' => 'Schema ëd la pàgina',
	'generatepages' => 'Generé le pàgine',
	'ps-generatepages-desc' => 'Generé le pàgine sì-dapress, basà dzora lë schema ëd costa categorìa:',
	'ps-generatepages-success' => 'Le pàgine selessionà a saran generà.',
	'ps-generatepages-noschema' => 'Eror: A-i é gnun schema ëd pàgina definì për costa categorìa.',
	'ps-generatepages-editsummary' => 'Generà da në schema ëd pàgina',
	'ps-page-desc-cat-not-exist' => 'Costa categorìa a esist ancor nen. Creé costa categorìa e sò schema ëd pàgina:',
	'ps-page-desc-ps-not-exist' => "Sta categorìa a esist, ma a l'ha pa në schema ëd pàgina. Creé lë schema:",
	'ps-page-desc-edit-schema' => "Ch'a modifica lë schema ëd pàgina për costa categorìa:",
	'ps-delimiter-label' => "Delimitador për ij valor (col predefinì a l'é «,»):",
	'ps-multiple-temp-label' => 'Përmëtte vàire istanse ëd së stamp',
	'ps-field-list-label' => 'Ël camp a peul conten-e na lista ëd valor',
	'ps-template' => 'Stamp',
	'ps-add-template' => 'Gionté në stamp',
	'ps-remove-template' => 'Gavé lë stamp',
	'ps-field' => 'Camp',
	'ps-namelabel' => 'Nòm:',
	'ps-displaylabel' => 'Tichëtta për la visualisassion:',
	'ps-add-field' => 'Gionté un camp',
	'ps-remove-field' => 'Gavé un camp',
	'ps-add-xml-label' => 'XML adissional:',
	'ps-optional-name' => 'Nòm (lassé veuid për amposté al nòm dël camp):',
	'editschema' => 'Modifiché lë schema',
	'createschema' => 'Creé lë schema',
	'right-generatepages' => 'Smon-e la scheda «Generé le pàgine» e la pàgina',
	'action-generatepages' => 'smon-e la scheda e la pàgina «{{int:Generatepages}}»',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'ps-template' => 'کينډۍ',
	'ps-add-template' => 'کينډۍ ورگډول',
	'ps-field' => 'ډګر',
	'ps-namelabel' => 'نوم:',
);

/** Portuguese (português)
 * @author Cainamarques
 * @author Hamilton Abreu
 * @author Luckas
 * @author Luckas Blade
 */
$messages['pt'] = array(
	'ps-desc' => 'Define a estrutura de dados de todas as páginas utilizando XML',
	'ps-template' => 'Predefinição',
	'ps-add-template' => 'Adicionar predefinição',
	'ps-remove-template' => 'Remover predefinição',
	'ps-namelabel' => 'Nome:',
	'ps-add-xml-label' => 'XML adicional:',
	'ps-level' => 'Nível',
	'ps-otherparams' => 'Outros parâmetros',
);

/** Brazilian Portuguese (português do Brasil)
 * @author Cainamarques
 * @author Daemorris
 * @author Jaideraf
 */
$messages['pt-br'] = array(
	'ps-desc' => 'Define a estrutura de dados para todas as páginas contidas em uma categoria utilizando XML',
	'ps-schema-description' => 'Esquema da página',
	'generatepages' => 'Gerar páginas',
	'ps-generatepages-desc' => 'Gere as seguintes páginas baseada neste esquema de categoria:',
	'ps-generatepages-success' => 'As páginas selecionadas serão geradas.',
	'ps-generatepages-noschema' => 'Erro: Não há nenhum esquema de página definida para esta categoria.',
	'ps-generatepages-editsummary' => 'Gerada a partir de um esquema de página',
	'ps-page-desc-cat-not-exist' => 'Esta categoria ainda não existe. Crie esta categoria e seu esquema de página:',
	'ps-page-desc-ps-not-exist' => 'Esta categoria existe, mas não tem um esquema de página. Crie o esquema:',
	'ps-page-desc-edit-schema' => 'Edite o esquema de página para esta categoria:',
	'ps-delimiter-label' => 'Delimitador para os valores (o padrão é ","):',
	'ps-multiple-temp-label' => 'Permitir várias instâncias desta predefinição',
	'ps-field-list-label' => 'Este campo pode conter uma lista de valores',
	'ps-template' => 'Predefinição',
	'ps-add-template' => 'Adicionar predefinição',
	'ps-remove-template' => 'Remover predefinição',
	'ps-field' => 'Campo',
	'ps-namelabel' => 'Nome:',
	'ps-displaylabel' => 'Exibir rótulo:',
	'ps-add-field' => 'Adicionar campo',
	'ps-remove-field' => 'Remover campo',
	'ps-add-xml-label' => 'XML adicional:',
	'ps-optional-name' => 'Nome (deixe em branco para definir o nome do campo):',
	'editschema' => 'Editar esquema',
	'createschema' => 'Criar esquema',
	'right-generatepages' => 'Ver página e guia "Gerar páginas"',
	'action-generatepages' => 'ver a página e guia "{{int:Generatepages}}"',
	'ps-add-section' => 'Adicionar seção',
	'ps-removepagesection' => 'Remover seção',
	'ps-sectionname' => 'Título da seção:',
	'ps-sectionlevel' => 'Nível da seção:',
	'ps-section' => 'Seção',
	'ps-level' => 'Nível',
	'ps-otherparams' => 'Outros parâmetros',
);

/** Romanian (română)
 * @author Minisarm
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'ps-desc' => 'Definește structura datelor pentru toate paginile dintr-o categorie, utilizând XML',
	'ps-schema-description' => 'Schema paginii',
	'generatepages' => 'Generare pagini',
	'ps-generatepages-desc' => 'Generează următoarele pagini pe baza schemei acestei categorii:',
	'ps-generatepages-success' => 'Paginile selectate vor fi generate.',
	'ps-generatepages-noschema' => 'Eroare: Nu există nicio schemă de pagină definită pentru această categorie.',
	'ps-generatepages-editsummary' => 'Generată dintr-o schemă de pagină',
	'ps-page-desc-cat-not-exist' => 'Această categorie nu există încă. Creați această categorie și schema de pagină asociată:',
	'ps-page-desc-ps-not-exist' => 'Această categorie există, dar nu are asociată o schemă de pagină. Creați schema:',
	'ps-page-desc-edit-schema' => 'Modificați schema de pagină pentru această categorie:',
	'ps-delimiter-label' => 'Delimitator pentru valori (implicit este „,”):',
	'ps-multiple-temp-label' => 'Permite mai multe instanțe ale acestui format',
	'ps-field-list-label' => 'Acest câmp poate conține o listă de valori',
	'ps-template' => 'Format',
	'ps-add-template' => 'Adaugă formatul',
	'ps-remove-template' => 'Elimină formatul',
	'ps-field' => 'Câmp',
	'ps-namelabel' => 'Nume:',
	'ps-displaylabel' => 'Afișează eticheta:',
	'ps-add-field' => 'Adaugă câmp',
	'ps-remove-field' => 'Șterge câmpul',
	'ps-add-xml-label' => 'XML suplimentar:',
	'ps-optional-name' => 'Nume (lăsați necompletat pentru a seta numele câmpului):',
	'editschema' => 'Modificare schemă',
	'createschema' => 'Creare schemă',
	'right-generatepages' => 'Vizualizează fila și pagina „Generare pagini”',
	'action-generatepages' => 'vizualizați fila și pagina „Generare pagini”', # Fuzzy
);

/** tarandíne (tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'ps-desc' => "Definisce le strutture de le date pe tutte le pàggene jndr'à 'na categorije ausanne l'XML",
	'ps-schema-description' => "Schema d'a pàgene",
	'ps-template' => 'Template',
	'ps-add-template' => "Aggiunge 'u template",
	'ps-remove-template' => "Live 'u template",
	'ps-field' => 'Cambe',
	'ps-namelabel' => 'Nome:',
	'ps-displaylabel' => 'Etichette de visualizzazzione:',
	'ps-add-field' => "Aggiunge 'u cambe",
	'ps-remove-field' => "Live 'u cambe",
	'ps-add-xml-label' => 'XML aggiundive:',
	'editschema' => "Cange 'u scheme",
	'createschema' => "Ccreje 'u scheme",
);

/** Russian (русский)
 * @author Eleferen
 * @author Kaganer
 * @author Okras
 * @author Александр Сигачёв
 */
$messages['ru'] = array(
	'ps-desc' => 'Определяет структуру данных для всех страниц в категории с помощью XML',
	'ps-schema-description' => 'Схема страниц',
	'generatepages' => 'Создание страниц',
	'ps-generatepages-desc' => 'Создать следующие страницы, основанные на схеме этой категории:',
	'ps-generatepages-success' => 'Выбранные страницы будут созданы.',
	'ps-generatepages-noschema' => 'Ошибка: нет схемы страниц, определенной для этой категории.',
	'ps-generatepages-editsummary' => 'Создано из схемы страниц',
	'ps-page-desc-cat-not-exist' => 'Эта категория ещё не существует. Создайте эту категорию и её схему страниц:',
	'ps-page-desc-ps-not-exist' => 'Эта категория существует, но не имеет схемы страниц. Создайте схему:',
	'ps-page-desc-edit-schema' => 'Отредактируйте схему страниц для этой категории:',
	'ps-delimiter-label' => 'Разделитель для значений (по умолчанию — «,»):',
	'ps-multiple-temp-label' => 'Разрешить несколько экземпляров этого шаблона',
	'ps-field-list-label' => 'Это поле может содержать список значений',
	'ps-template' => 'Шаблон',
	'ps-add-template' => 'Добавить шаблон',
	'ps-remove-template' => 'Удалить шаблон',
	'ps-field' => 'Поле',
	'ps-namelabel' => 'Имя:',
	'ps-displaylabel' => 'Отображаемая надпись:',
	'ps-add-field' => 'Добавить поле',
	'ps-remove-field' => 'Удалить поле',
	'ps-add-xml-label' => 'Дополнительный XML:',
	'ps-optional-name' => 'Имя (оставьте пустым, чтобы использовать имя поля):',
	'editschema' => 'Изменить схему',
	'createschema' => 'Создать схему',
	'right-generatepages' => 'Просмотреть вкладку и страницу «{{int:generatepages}}»',
	'action-generatepages' => 'просмотр вкладки и страницы «{{int:Generatepages}}»',
	'ps-add-section' => 'Добавить раздел',
	'ps-removepagesection' => 'Удалить раздел',
	'ps-sectionname' => 'Название раздела:',
	'ps-sectionlevel' => 'Уровень раздела:',
	'ps-section' => 'Раздел',
	'ps-level' => 'Уровень',
	'ps-otherparams' => 'Другие параметры',
	'ps-createpage-irregulartext' => 'Страница «$1» не содержит правильный вики-текст.',
	'ps-createpage-invalidtitle' => 'Недопустимое название',
	'ps-createpage-notfound' => 'Статья не найдена',
	'ps-field-display-always' => 'Всегда отображать это поле',
	'ps-field-display-notempty' => 'Отображать, если не пустое',
	'ps-field-display-hide' => 'Скрыть',
	'ps-field-namespace' => 'Это поле всегда будет иметь значения в следующих пространствах имён:',
);

/** Sakha (саха тыла)
 * @author HalanTul
 */
$messages['sah'] = array(
	'generatepages' => 'Сирэйдэри айыы',
);

/** Scots (Scots)
 * @author John Reid
 */
$messages['sco'] = array(
	'ps-field-namespace' => 'This field will aawaws hae values in the follaeing namespace:',
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'ps-schema-description' => 'පිටුවේ සංක්ෂිප්ත නිරූපණය',
	'generatepages' => 'පිටු ජනිත කරන්න',
	'ps-generatepages-success' => 'තෝරාගත් පිටු ජනිත වෙමින් පවතී.',
	'ps-generatepages-editsummary' => 'පිටුවේ සංක්ෂිප්ත නිරූපණයෙන් ජනිත කරන ලදී',
	'ps-page-desc-edit-schema' => 'මෙම ප්‍රවර්ගය සඳහා පිටු සංක්ෂිප්ත නිරූපණය සංස්කරණය කරන්න:',
	'ps-multiple-temp-label' => 'මෙම සැකිල්ලේ බහුවිධ දෘෂ්ටාන්තවලට ඉඩදෙන්න',
	'ps-template' => 'සැකිල්ල',
	'ps-add-template' => 'සැකිල්ල එක් කරන්න',
	'ps-remove-template' => 'සැකිල්ල ඉවත් කරන්න',
	'ps-field' => 'ක්ෂේත්‍රය',
	'ps-namelabel' => 'නම:',
	'ps-displaylabel' => 'ලේබලය පෙන්වන්න:',
	'ps-add-field' => 'ක්ෂේත්‍රය එක් කරන්න',
	'ps-remove-field' => 'ක්ෂේත්‍රය ඉවත් කරන්න',
	'ps-add-xml-label' => 'අමතර XML:',
	'editschema' => 'සංක්ෂිප්ත නිරූපණය සංස්කරණය කරන්න',
	'createschema' => 'සංක්ෂිප්ත නිරූපණය තනන්න',
);

/** Slovenian (slovenščina)
 * @author Dbc334
 */
$messages['sl'] = array(
	'ps-desc' => 'Opredeljuje zgradbo podatkov vseh strani v kategoriji z uporabo XML',
	'ps-schema-description' => 'Shema strani',
	'generatepages' => 'Ustvari strani',
	'ps-generatepages-desc' => 'Ustvari naslednje strani, temelječe na shemi te kategorije:',
	'ps-generatepages-success' => 'Ustvarjene bodo naslednje strani.',
	'ps-generatepages-noschema' => 'Napaka: Kategorija nima določene sheme strani.',
	'ps-generatepages-editsummary' => 'Ustvarjeno iz sheme strani',
	'ps-page-desc-cat-not-exist' => 'Ta kategorija še ne obstaja. Ustvarite kategorijo in njeno shemo strani:',
	'ps-page-desc-ps-not-exist' => 'Ta kategorija obstaja, vendar nima sheme strani. Ustvarite shemo:',
	'ps-page-desc-edit-schema' => 'Uredi shemo strani te kategorije:',
	'ps-delimiter-label' => 'Ločilo vrednosti (privzeto je »,«):',
	'ps-multiple-temp-label' => 'Dovoli več primerkov predloge',
	'ps-field-list-label' => 'Polje lahko vsebuje seznam vrednosti',
	'ps-template' => 'Predloga',
	'ps-add-template' => 'Dodaj predlogo',
	'ps-remove-template' => 'Odstrani predlogo',
	'ps-field' => 'Polje',
	'ps-namelabel' => 'Ime:',
	'ps-displaylabel' => 'Prikaži oznako:',
	'ps-add-field' => 'Dodaj polje',
	'ps-remove-field' => 'Odstrani polje',
	'ps-add-xml-label' => 'Dodatni XML:',
	'ps-optional-name' => 'Ime (pustite prazno, da nastavite na ime polje):',
	'editschema' => 'Uredi shemo',
	'createschema' => 'Ustvarite shemo',
	'right-generatepages' => 'Ogled zavihka in strani »{{int:generatepages}}«',
	'action-generatepages' => 'ogled zavihka in strani »{{int:Generatepages}}«',
	'ps-add-section' => 'Dodaj razdelek',
	'ps-removepagesection' => 'Odstrani razdelek',
	'ps-sectionname' => 'Ime razdelka:',
	'ps-sectionlevel' => 'Raven razdelka:',
	'ps-section' => 'Razdelek',
	'ps-level' => 'Raven',
	'ps-otherparams' => 'Drugi parametri',
	'ps-createpage-irregulartext' => 'Wikistran »$1« ne vsebuje navadnega wikibesedila.',
	'ps-createpage-invalidtitle' => 'Neveljavni naslov',
	'ps-createpage-notfound' => 'Članka ni mogoče najti',
	'ps-field-display-always' => 'Polje vedno prikaži',
	'ps-field-display-notempty' => 'Prikaži, če ni prazno',
	'ps-field-display-hide' => 'Skrij',
	'ps-field-namespace' => 'Polje bo vedno imelo vrednosti v naslednjih imenskih prostorih:',
);

/** Serbian (Cyrillic script) (српски (ћирилица)‎)
 * @author Rancher
 */
$messages['sr-ec'] = array(
	'ps-desc' => 'Одређује структуру података за све странице у категорији користећи XML',
);

/** Serbian (Latin script) (srpski (latinica)‎)
 */
$messages['sr-el'] = array(
	'ps-desc' => 'Određuje strukturu podataka za sve stranice u kategoriji koristeći XML',
);

/** Swedish (svenska)
 * @author Jopparn
 * @author Martinwiss
 * @author Per
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'ps-desc' => 'Definierar en datastruktur för alla sidor i en kategori m.h.a. XML',
	'ps-schema-description' => 'Sidschema',
	'generatepages' => 'Generera sidor',
	'ps-generatepages-desc' => 'Generera dessa sidor utifrån den här kategorins strukturdefinition:',
	'ps-generatepages-success' => 'De valda sidorna kommer att skapas',
	'ps-generatepages-noschema' => 'Fel: Det finns ingen strukturdefinition för den här kategorin.',
	'ps-generatepages-editsummary' => 'Skapad från strukturdefinition',
	'ps-page-desc-cat-not-exist' => 'Den här kategorin finns inte ännu. Skapa kategorin och dess strukturdefinition:',
	'ps-page-desc-ps-not-exist' => 'Den här kategorin finn men har ingen strukturdefinition. Skapa strukturdefinition:',
	'ps-page-desc-edit-schema' => 'Redigera strukturdefinition för den här kategorin:',
	'ps-delimiter-label' => 'Tecken för att avgränsa värden ("," är förvalt):',
	'ps-multiple-temp-label' => 'Tillåt många varianter av den här mallen',
	'ps-field-list-label' => 'Det här fältet kan innehålla en lista med värden',
	'ps-template' => 'Mall',
	'ps-add-template' => 'Lägg till mall',
	'ps-remove-template' => 'Ta bort mall',
	'ps-field' => 'Fält',
	'ps-namelabel' => 'Namn:',
	'ps-displaylabel' => 'Visa etikett:',
	'ps-add-field' => 'Lägg till fält',
	'ps-remove-field' => 'Ta bort fält',
	'ps-add-xml-label' => 'Tilläggande XML:',
	'ps-optional-name' => 'Namn (fältnamnet används om du inte anger värde)',
	'editschema' => 'Redigera schema',
	'createschema' => 'Skapa schema',
	'right-generatepages' => 'Visa fliken och sidan "{{int:generatepages}}"',
	'action-generatepages' => 'visa fliken och sidan "{{int:Generatepages}}"',
	'ps-level' => 'Nivå',
	'ps-otherparams' => 'Andra parametrar',
	'ps-createpage-irregulartext' => 'Wikisidan "$1" innehåller inte vanlig wikitext.',
	'ps-createpage-invalidtitle' => 'Ogiltig titel',
	'ps-createpage-notfound' => 'Artikel hittades inte',
	'ps-field-display-always' => 'Visa alltid detta fält',
	'ps-field-display-hide' => 'Dölj',
);

/** Tamil (தமிழ்)
 * @author Karthi.dr
 * @author Shanmugamp7
 */
$messages['ta'] = array(
	'generatepages' => 'பக்கங்களை உருவாக்கு',
	'ps-template' => 'வார்ப்புரு',
	'ps-add-template' => 'வார்ப்புருவைச் சேர்',
	'ps-remove-template' => 'வார்ப்புருவை நீக்கு',
	'ps-field' => 'புலம்',
	'ps-namelabel' => 'பெயர்:',
	'ps-add-field' => 'புலத்தைச் சேர்',
	'ps-remove-field' => 'புலத்தை நீக்கு',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'ps-desc' => 'Nagbibigay ng kahulugan sa kayarian ng dato para sa lahat ng mga pahina sa loob ng isang kategorya na ginagamit ang XML',
	'ps-schema-description' => 'Panukala sa pahina',
	'generatepages' => 'Lumikha ng mga pahina',
	'ps-generatepages-desc' => 'Likhain ang sumusunod na mga pahina, na nakabatay sa panukala ng kategoryang ito:',
	'ps-generatepages-success' => 'Lilikhain ang napiling mga pahina.',
	'ps-generatepages-noschema' => 'Kamalian: Walang panukala sa pahina na binigyan ng kahulugan para sa kategoryang ito.',
	'ps-generatepages-editsummary' => 'Nilikha mula sa isang panukala sa isang pahina',
	'ps-page-desc-cat-not-exist' => 'Hindi pa umiiral ang kategoryang ito. Likhain ang kategoryang ito at ang panukala sa pahina nito:',
	'ps-page-desc-ps-not-exist' => 'Umiiral ang kategoryang ito, subalit walang panukala sa pahina. Likhain ang panukala:',
	'ps-page-desc-edit-schema' => 'Baguhin ang panukala sa pahina para sa kategoryang ito:',
	'ps-delimiter-label' => 'Pantakda ng hangganan para sa mga halaga (ang likas na nakatakda ay ang ","):',
	'ps-multiple-temp-label' => 'Payagan ang maramihang mga pagkakataon ng suleras na ito',
	'ps-field-list-label' => 'Ang hanay na ito ay makakahawak ng isang listahan ng mga halaga',
	'ps-template' => 'Suleras',
	'ps-add-template' => 'Magdagdag ng suleras',
	'ps-remove-template' => 'Tanggalin ang suleras',
	'ps-field' => 'Kahanayan',
	'ps-namelabel' => 'Pangalan:',
	'ps-displaylabel' => 'Katatakan ng ipinapakita:',
	'ps-add-field' => 'Magdagdag ng hanay',
	'ps-remove-field' => 'Tanggalin ang hanay',
	'ps-add-xml-label' => 'Karagdagang XML:',
	'ps-optional-name' => 'Pangalan (iwanang walang laman upang itakda sa pangalan ng hanay):',
	'editschema' => 'Baguhin ang panukala',
	'createschema' => 'Likhain ang panukala',
	'right-generatepages' => 'Tingnan ang laylay na "Lumikha ng mga pahina" at pahina',
	'action-generatepages' => 'tingnan ang laylay na "Lumikha ng mga pahina" at pahina', # Fuzzy
);

/** Turkish (Türkçe)
 * @author Hedda Gabler
 * @author Incelemeelemani
 * @author Suelnur
 * @author Vito Genovese
 */
$messages['tr'] = array(
	'ps-desc' => 'XML kullanarak bir kategoride yer alan bütün sayfalar için veri yapısını tanımlamaktadır',
	'ps-schema-description' => 'Sayfa şeması',
	'generatepages' => 'Sayfaları oluşturun',
	'ps-generatepages-success' => 'Seçilen sayfalar oluşturulacaktır.',
	'ps-generatepages-noschema' => 'Hata: Bu kategori için tanımlanmış bir sayfa şeması yoktur.',
	'ps-delimiter-label' => 'Değerler için sınırlayıcı (varsayılan ","):',
	'ps-template' => 'Şablon',
	'ps-add-template' => 'Şablon ekle:',
	'ps-remove-template' => 'Şablonu kaldır',
	'ps-field' => 'Alan',
	'ps-namelabel' => 'İsim:',
	'ps-displaylabel' => 'Görüntülenen etiket:',
	'ps-add-field' => 'Alan ekle',
	'ps-remove-field' => 'Alanı kaldır',
	'ps-add-xml-label' => 'İlave XML:',
	'ps-optional-name' => 'İsim (Alan adını ayarlamak için boş bırakın):',
	'editschema' => 'Şemayı düzenle',
	'createschema' => 'Şema oluştur',
	'right-generatepages' => '"Sayfa oluştur" sekmesini ve sayfasını görüntüle',
	'action-generatepages' => '"Sayfa oluştur" sekmesini ve sayfasını görüntüle', # Fuzzy
);

/** Ukrainian (українська)
 * @author Andriykopanytsia
 * @author Base
 * @author NickK
 * @author Prima klasy4na
 * @author Тест
 */
$messages['uk'] = array(
	'ps-desc' => 'Визначає структуру даних усіх сторінок категорії через XML',
	'ps-schema-description' => 'Схема сторінки',
	'generatepages' => 'Створення сторінок',
	'ps-generatepages-desc' => 'Створити наступні сторінки, основані на схемі цієї категорії:',
	'ps-generatepages-success' => 'Обрані сторінки буде створено.',
	'ps-generatepages-noschema' => 'Помилка: Для цієї категорії не визначено схему сторінки.',
	'ps-generatepages-editsummary' => 'Створено зі схеми сторінки',
	'ps-page-desc-cat-not-exist' => 'Ця категорія ще не існує. Створити цю категорію і її схему сторінки:',
	'ps-page-desc-ps-not-exist' => 'Ця категорія існує, але не має схеми сторінки. Створити схему:',
	'ps-page-desc-edit-schema' => 'Редагувати схему сторінки для цієї категорії:',
	'ps-delimiter-label' => 'Розділювач для значень (за замовчуванням «,»):',
	'ps-multiple-temp-label' => 'Дозволити декілька варіантів цього шаблону',
	'ps-field-list-label' => 'Це поле може включати список значень',
	'ps-template' => 'Шаблон',
	'ps-add-template' => 'Додати шаблон',
	'ps-remove-template' => 'Вилучити шаблон',
	'ps-field' => 'Поле',
	'ps-namelabel' => 'Назва:',
	'ps-displaylabel' => 'Показувати мітку:',
	'ps-add-field' => 'Додати поле',
	'ps-remove-field' => 'Вилучити поле',
	'ps-add-xml-label' => 'Додатковий XML:',
	'ps-optional-name' => 'Назва (залишити порожнім для такої ж як назва поля):',
	'editschema' => 'Редагувати схему',
	'createschema' => 'Створити схему',
	'right-generatepages' => 'Переглядати вкладку і сторінку "{{int:generatepages}}"',
	'action-generatepages' => 'переглянути вкладку "{{int:Generatepages}}" і сторінку',
	'ps-add-section' => 'Додати розділ',
	'ps-removepagesection' => 'Вилучити розділ',
	'ps-sectionname' => 'Назва розділу:',
	'ps-sectionlevel' => 'Рівень розділу:',
	'ps-section' => 'Розділ',
	'ps-level' => 'Рівень',
	'ps-otherparams' => 'Інші параметри',
	'ps-createpage-irregulartext' => 'Вікі-сторінка "$1" не містить регулярного тексту вікі.',
	'ps-createpage-invalidtitle' => 'Невірний заголовок',
	'ps-createpage-notfound' => 'Статтю не знайдено',
	'ps-field-display-always' => 'Відображати це поле завжди',
	'ps-field-display-notempty' => 'Відображати, якщо поле не порожнє',
	'ps-field-display-hide' => 'Приховати',
	'ps-field-namespace' => 'Це поле завжди буде мати значення в такому просторі імен:',
);

/** Urdu (اردو)
 * @author පසිඳු කාවින්ද
 */
$messages['ur'] = array(
	'ps-remove-template' => 'سانچے کو حذف کریں',
	'ps-field' => 'میدان',
	'ps-namelabel' => 'نام:',
	'ps-displaylabel' => 'ڈسپلے لیبل:',
	'ps-add-field' => 'فیلڈ کا اضافہ کریں',
	'ps-remove-field' => 'میدان حذف کریں',
);

/** Vietnamese (Tiếng Việt)
 * @author Minh Nguyen
 * @author පසිඳු කාවින්ද
 */
$messages['vi'] = array(
	'ps-desc' => 'Định rõ cấu trúc dữ liệu của tất cả các trang trong một thể loại dùng mã XML',
	'ps-template' => 'Bản mẫu',
	'ps-namelabel' => 'Tên:',
);

/** Yiddish (ייִדיש)
 * @author פוילישער
 * @author පසිඳු කාවින්ද
 */
$messages['yi'] = array(
	'ps-namelabel' => 'נאָמען:',
	'ps-add-section' => 'צולייגן ניווא',
	'ps-removepagesection' => 'אראפנעמען אפטייל',
	'ps-sectionname' => 'אפטייל נאמען:',
	'ps-sectionlevel' => 'אפטייל ניווא:',
	'ps-section' => 'אפטייל',
	'ps-level' => 'ניווא',
	'ps-otherparams' => 'אנדערע פאראמעטערס',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Chenxiaoqino
 * @author Dimension
 * @author Kuailong
 * @author Li3939108
 * @author Liangent
 * @author Liuxinyu970226
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'ps-desc' => '使用XML为分类中的所有页面定义数据结构',
	'generatepages' => '生成页面',
	'ps-template' => '模板',
	'ps-add-template' => '添加模板',
	'ps-remove-template' => '移除模板',
	'ps-field' => '字段',
	'ps-namelabel' => '名称：',
	'ps-displaylabel' => '显示标签：',
	'ps-add-field' => '添加字段',
	'ps-remove-field' => '移除字段',
	'ps-level' => '等级',
	'ps-createpage-invalidtitle' => '标题无效',
	'ps-createpage-notfound' => '未找到条目',
	'ps-field-display-always' => '总是显示此字段',
	'ps-field-display-notempty' => '显示，如果不为空',
	'ps-field-display-hide' => '隐藏',
);

/** Traditional Chinese (中文（繁體）‎)
 * @author Liangent
 * @author Mark85296341
 */
$messages['zh-hant'] = array(
	'ps-desc' => '使用XML爲分類中的所有頁面定義數據結構',
);
