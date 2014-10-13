if (typeof AW === "undefined") var AW = {};

AW.localize = {};

// Language-Region Strings
AW.localize["en-US"] = {
	// Aspera Installer error codes for Connect installation
	"ErrInstallerNotSigned"	: "Installer not signed by Aspera", 
	"ErrExecution"			: "Failed to execute required command", 
	"ErrElevation"			: "Failed to elevate out of Protected Mode",
	"ErrGuestSupport"		: "Guest user installation is not supported", 
	"ErrDiskSpace"			: "Not enough disk space", 
	"ErrDownload"			: "Failed to download install package",
	"ErrMsiInstallationFailed": "MSI installation failed.",
	"ErrInProgress"			: "Installation is already in progress.",
	// Aspera Installer error_admin_rights
	"ErrAdminRights"		: "Admin rights required. Installer must be downloaded and run.",
	"Download"				: "Download now.",
	// Codes for AW.ConnectInstaller.getEnvSupportInfo() messages
	"chromeBrowser" : "Please download and run the installer.",
	"chromeNoNpapi" : "Aspera Connect is not supported by this version of Google Chrome. Please check for compatible browsers at <a href='http://asperasoft.com/connect'>asperasoft.com/connect</a>.",
	"legacy10_4Safari4_0" 	: "It looks like you're running Safari 4 on Mac OS X 10.4.",
	"10_5Safari4_0" 		: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Get the latest Safari browser now</a>.<p>Otherwise, download the installer from the link below.</p>",
	"10_5Safari5_0" 		: "It looks like you're running Safari 5 on Mac OS X 10.5.",
	"10_6Safari5_0"			: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Get the latest Safari browser now</a>, or download the installer. The plug-in will only work in 32-bit mode.</p>",
	"firefox310_5Plus"		: "Unfortunately Aspera Connect is not supported on this version of Firefox. <br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Get the latest Firefox browser now</a>.",
	"firefox3Win"			: "Unfortunately Aspera Connect is not supported on this version of Firefox. <br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Get the latest Firefox browser now</a>.",
	"win64BitBrowser"		: "It looks like you're using a 64-bit browser. Aspera Connect is supported on 32-bit browsers only.",
	"lteIE6" 				: "Unfortunately Aspera Connect is not supported on this version of Internet Explorer. Please upgrade. <br /><a onclick='window.open(this.href);return false;' href='http://microsoft.com/ie'>Get the latest Internet Explorer now</a>.",
	"linux32"				: "Please download Aspera Connect and run the Linux installer script.",
	"linux64"				: "Please download Aspera Connect and run the Linux installer script.",
	"firefox3Linux" 		: "Unfortunately Aspera Connect is not supported on this version of Firefox. <br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Get the latest Firefox browser now</a>.",
	"unsupportedBrowser"	: "Unfortunately Aspera Connect is not supported on this browser.",
	"unsupportedOS"			: "Unfortunately Aspera Connect is not supported on operating system.",
	"unsupportedBrowserAndOS"	: "Unfortunately Aspera Connect is not supported on this browser and operating system.",
	// Connect installer pages (auto and auto-iframe)
	"availableVersionLowerThanMinVersion" : "This website requires a version of Aspera Connect that is not yet available for this platform.",
	"downloadPackage"		: "Download Aspera Connect",
	"downloadInstaller"		: "download the installer",
	"downloadAndInstall"    : "Please download and install Aspera Connect.",
	"javaFailed"            : "Unable to perform automatic installation (no Java). Please download and install. <a href='http://asperasoft.com/connect' target='_blank' class='link'>Learn more</a>.",
	"promptMessage"			: "Aspera Connect is used by this site to transfer files quickly and securely.",
	"installerTitle"		: "Aspera Connect installer",
	"statusTitle"			: "Aspera Connect installer status",
	"installNow"			: "Install Aspera Connect",
	"upgradeNow"			: "Upgrade Aspera Connect",
	"cancel"				: "Cancel",
	"quitBrowsers"			: "Please quit other browsers running Aspera Connect before continuing.",
	"continue"				: "Continue",
	"installing"			: "Installing",
	"downloading"			: "Downloading",
	"starting"				: "Starting",
	"error"					: "Error",
	"safariInstallerInstructions" : "Choose \"Allow\" if prompted to begin installing Aspera Connect.",
	"firefoxInstallerInstructions"	: "Choose \"Allow\" if prompted to begin installing Aspera Connect.",
	"ieInstallerInstructions"	: "Choose \"Install\" if prompted to begin installing Aspera Connect.",
	"generalInstallerInstructions"	: "Click \"Allow\" or \"Continue\" if prompted.",
	"installComplete"		: "Installation complete.",
	"restartBrowser"		: "Please restart your browser to begin using Aspera Connect.",
	"refreshBrowser"		: "Please refresh your browser\'s window to begin using Aspera Connect.",
	"restartNow"			: "Restart Now",
	"refreshNow"			: "Refresh Now",
	"confirmInstallLeave"	: "Please wait for the installer to finish.",
	"popupOpen"				: "Another window has opened. Please follow the instructions in that window to finish installing Aspera Connect.",
	"pluginInstallInfo"		: "This will quickly install the Aspera Installer Plugin. The Aspera Connect software will automatically install next.",
	"version"				: "Version",
	"installThankYou"		: "Thank you for running the latest Aspera Connect.",
	"skipAutoInstall"		:"To skip the automatic installation process,"
};

AW.localize["es-ES"] = {
	// Aspera Installer error codes for Connect installation
	"ErrInstallerNotSigned"	: "Instalador no firmado por Aspera", 
	"ErrExecution"			: "No se ha podido ejecutar la orden necesaria", 
	"ErrElevation"			: "No ha sido posible salir del modo protegido",
	"ErrGuestSupport"		: "No se admite la instalación de usuario invitado", 
	"ErrDiskSpace"			: "No hay suficiente espacio en disco", 
	"ErrDownload"			: "No ha sido posible descargar el paquete de instalación",
	"ErrMsiInstallationFailed": "Fallo de instalación de MSI.",
	"ErrInProgress"			: "La instalación ya está en curso.",
	// Aspera Installer error_admin_rights
	"ErrAdminRights"		: "Derechos de administrador necesarios. Se debe descargar y ejecutar el instalador.",
	"Download"				: "Descargue ahora.",
	// Codes for AW.ConnectInstaller.getEnvSupportInfo() messages
	"chromeBrowser" : "Descargue y ejecute el instalador.",
	"legacy10_4Safari4_0" 	: "Parece ser que está utilizando Safari 4 en Mac OS X 10.4.",
	"downloadInstaller"		: "descargue el instalador",
	"10_5Safari4_0" 		: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Descárguese el explorador Safari más reciente ahora</a>.<p>O bien descargue el instalador desde el vínculo siguiente.</p>",
	"10_5Safari5_0" 		: "Parece ser que está utilizando Safari 5 en Mac OS X 10.5.",
	"10_6Safari5_0"			: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Descárguese el explorador Safari más reciente ahora</a> o descargue el instalador. El complemento solo funcionará en modo de 32 bits.</p>",
	"firefox310_5Plus"		: "Desafortunadamente, esta versión de Firefox no admite Aspera Connect.<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Descárguese el explorador Firefox más reciente ahora</a>.",
	"firefox3Win"			: "Desafortunadamente, esta versión de Firefox no admite Aspera Connect.<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Descárguese el explorador Firefox más reciente ahora</a>.",
	"win64BitBrowser"		: "Parece ser que está utilizando un explorador de 64 bits. Aspera Connect solo es compatible con exploradores de 32 bits.",
	"lteIE6" 				: "Desafortunadamente, esta versión de Internet Explorer no admite Aspera Connect. Actualice la versión. <br /><a onclick='window.open(this.href);return false;' href='http://microsoft.com/ie'>Descárguese la versión más reciente de Internet Explorer ahora</a>.",
	"linux32"				: "Descargue Aspera Connect y ejecute el script de instalador de Linux.",
	"linux64"				: "Descargue Aspera Connect y ejecute el script de instalador de Linux.",
	"firefox3Linux" 		: "Desafortunadamente, esta versión de Firefox no admite Aspera Connect.<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Descárguese el explorador Firefox más reciente ahora</a>.",
	"unsupportedBrowser"	: "Desafortunadamente, este explorador no admite Aspera Connect.",
	"unsupportedOS"			: "Desafortunadamente, el sistema operativo no admite Aspera Connect.",
	"unsupportedBrowserAndOS"	: "Desafortunadamente, este explorador y el sistema operativo no admiten Aspera Connect.",
	// Connect installer pages (auto and auto-iframe)
	"availableVersionLowerThanMinVersion" : "Este sitio web requiere una versión de Aspera Connect que aún no está disponible para esta plataforma.",
	"downloadPackage"		: "Descargar Aspera Connect",
	"downloadAndInstall"    : "Descargue e instale Aspera Connect.",
	"javaFailed"            : "No se puede realizar la instalación automática (sin Java). Descargue e instale. <a href='http://asperasoft.com/connect' target='_blank' class='link'>Más información</a>.",
	"promptMessage"			: "Este sitio utiliza Aspera Connect para transferir archivos de forma rápida y segura.",
	"installerTitle"		: "Instalador de Aspera Connect",
	"statusTitle"			: "Estado de instalador de Aspera Connect",
	"installNow"			: "Instalar Aspera Connect",
	"upgradeNow"			: "Actualizar Aspera Connect",
	"cancel"				: "Cancelar",
	"quitBrowsers"			: "Salga del resto de exploradores que ejecutan Aspera Connect antes de continuar.",
	"continue"				: "Continuar",
	"installing"			: "Instalación",
	"downloading"			: "Descarga",
	"starting"				: "Inicio",
	"error"					: "Error",
	"safariInstallerInstructions" : "Elija \"Permitir\" si se le pide que comience la instalación de Aspera Connect.",
	"firefoxInstallerInstructions"	: "Elija \"Permitir\" si se le pide que comience la instalación de Aspera Connect.",
	"ieInstallerInstructions"	: "Elija \"Instalar\" si se le pide que comience la instalación de Aspera Connect.",
	"generalInstallerInstructions"	: "Haga clic en \"Permitir\" o en \"Continuar\" si se le indica.",
	"installComplete"		: "Instalación finalizada.",
	"restartBrowser"		: "Reinicie el explorador para comenzar a utilizar Aspera Connect.",
	"refreshBrowser"		: "Actualice las ventanas del explorador para comenzar a utilizar Aspera Connect.",
	"restartNow"			: "Reiniciar ahora",
	"refreshNow"			: "Actualizar ahora",
	"confirmInstallLeave"	: "Espere a que el instalador finalice.",
	"popupOpen"				: "Se ha abierto otra ventana. Siga las instrucciones de esa ventana para finalizar la instalación de Aspera Connect.",
	"pluginInstallInfo"		: "Esta operación instalará rápidamente el complemento de instalador de Aspera. El software Aspera Connect se instalará automáticamente a continuación.",
	"version"				: "Versión",
	"installThankYou"		: "Gracias por ejecutar la versión más reciente de Aspera Connect.",
	"skipAutoInstall"		:"Para omitir el proceso de instalación automática,"
};

AW.localize["fr-FR"] = {
	// Aspera Installer error codes for Connect installation
	"ErrInstallerNotSigned"	: "Le programme d'installation n'est pas signé par Aspera.", 
	"ErrExecution"			: "Impossible d'exécuter la commande requise.", 
	"ErrElevation"			: "Impossible de sortir du mode protégé",
	"ErrGuestSupport"		: "L'installation pour utilisateur invité n'est pas prise en charge", 
	"ErrDiskSpace"			: "Espace disque insuffisant", 
	"ErrDownload"			: "Impossible de télécharger le package d'installation",
	"ErrMsiInstallationFailed": "Échec de l'installation de MSI.",
	"ErrInProgress"			: "L'installation est déjà en cours d'exécution.",
	// Aspera Installer error_admin_rights
	"ErrAdminRights"		: "Droits de l'administrateur requis. Le programme d'installation doit être téléchargé et exécuté.",
	"Download"				: "Télécharger dès maintenant.",
	// Codes for AW.ConnectInstaller.getEnvSupportInfo() messages
	"chromeBrowser" : "Veuillez télécharger et exécuter le programme d'installation.",
	"legacy10_4Safari4_0" 	: "Vous utilisez Safari 4 sous Mac OS X 10.4 ?",
	"10_5Safari4_0" 		: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Obtenez dès maintenant la dernière version du navigateur Safari</a>.<p>Sinon, téléchargez le programme d'installation à partir du lien ci-dessous.</p>",
	"10_5Safari5_0" 		: "Vous utilisez Safari 5 sous Mac OS X 10.5 ?",
	"10_6Safari5_0"			: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Obtenez dès maintenant la dernière version du navigateur Safari</a> ou téléchargez le programme d'installation. Le plug-in fonctionnera uniquement en mode 32 bits.</p>",
	"firefox310_5Plus"		: "Aspera Connect n'est pas pris en charge sur cette version de Firefox.<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Obtenez la dernière version du navigateur Firefox dès maintenant</a>.",
	"firefox3Win"			: "Aspera Connect n'est pas pris en charge sur cette version de Firefox.<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Obtenez la dernière version du navigateur Firefox dès maintenant</a>.",
	"win64BitBrowser"		: "Vous utilisez un navigateur 64 bits ? Aspera Connect est uniquement pris en charge sur les navigateurs 32 bits.",
	"lteIE6" 				: "Aspera Connect n'est pas pris en charge sur cette version de Internet Explorer. Veuillez mettre à niveau. <br /><a onclick='window.open(this.href);return false;' href='http://microsoft.com/ie'>Obtenez la dernière version d'Internet Explorer dès maintenant</a>.",
	"linux32"				: "Veuillez télécharger Aspera Connect et exécuter le script du programme d'installation de Linux.",
	"linux64"				: "Veuillez télécharger Aspera Connect et exécuter le script du programme d'installation de Linux.",
	"firefox3Linux" 		: "Aspera Connect n'est pas pris en charge sur cette version de Firefox.<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Obtenez la dernière version du navigateur Firefox dès maintenant</a>.",
	"unsupportedBrowser"	: "Aspera Connect n'est pas pris en charge sur ce navigateur.",
	"unsupportedOS"			: "Aspera Connect n'est pas pris en charge sur ce système d'exploitation.",
	"unsupportedBrowserAndOS"	: "Aspera Connect n'est pas pris en charge sur ce navigateur et ce système d'exploitation.",
	// Connect installer pages (auto and auto-iframe)
	"availableVersionLowerThanMinVersion" : "Ce site Web requiert une version d'Aspera Connect qui n'est pas encore disponible pour cette plateforme.",
	"downloadPackage"		: "Télécharger Aspera Connect",
	"downloadInstaller"		: "téléchargez l'installeur",
	"downloadAndInstall"    : "Veuillez télécharger et installer Aspera Connect.",
	"javaFailed"            : "Impossible de procéder à l'installation automatique (aucune version de Java). Veuillez télécharger et installer. <a href='http://asperasoft.com/connect' target='_blank' class='link'>En apprendre davantage</a>.",
	"promptMessage"			: "Aspera Connect est utilisé par ce site pour transférer les fichiers rapidement et en toute sécurité.",
	"installerTitle"		: "Programme d'installation Aspera Connect",
	"statusTitle"			: "Statut du programme d'installation d'Aspera Connect",
	"installNow"			: "Installer Aspera Connect",
	"upgradeNow"			: "Mettre à niveau Aspera Connect",
	"cancel"				: "Annuler",
	"quitBrowsers"			: "Veuillez quitter les autres navigateurs exécutant Aspera Connect avant de poursuivre.",
	"continue"				: "Poursuivre",
	"installing"			: "Installation",
	"downloading"			: "Téléchargement",
	"starting"				: "Démarrage",
	"error"					: "Erreur",
	"safariInstallerInstructions" : "Choisissez \"Autoriser\" si l'invite s'affiche pour commencer à installer Aspera Connect.",
	"firefoxInstallerInstructions"	: "Choisissez \"Autoriser\" si l'invite s'affiche pour commencer à installer Aspera Connect.",
	"ieInstallerInstructions"	: "Choisissez \"Installer\" si l'invite s'affiche pour commencer à installer Aspera Connect.",
	"generalInstallerInstructions"	: "Cliquez sur \"Autoriser\" ou \"Continuer\" si l'invite s'affiche. ",
	"installComplete"		: "Installation terminée.",
	"restartBrowser"		: "Veuillez redémarrer votre navigateur pour commencer à utiliser Aspera Connect.",
	"refreshBrowser"		: "Veuillez réactualiser votre navigateur pour commencer à utiliser Aspera Connect.",
	"restartNow"			: "Redémarrer maintenant.",
	"refreshNow"			: "Réactualiser maintenant.",
	"confirmInstallLeave"	: "Veuillez patientez pendant que le programme d'installation termine.",
	"popupOpen"				: "Une autre fenêtre s'est ouverte. Veuillez suivre les instructions de cette fenêtre pour terminer l'installation d'Aspera Connect.",
	"pluginInstallInfo"		: "Ceci procèdera à l'installation rapide du plug-in du programme d'installation d'Aspera. Le logiciel Aspera Connect s'installera ensuite automatiquement.",
	"version"				: "Version",
	"installThankYou"		: "Merci d'exécuter la dernière version d'Aspera Connect.",
	"skipAutoInstall"		:"Pour empêcher le processus d'installation automatique,"
};

AW.localize["ja-JP"] = {
	// Aspera Installer error codes for Connect installation
	"ErrInstallerNotSigned"	: "インストーラがAsperaによって署名されていません", 
	"ErrExecution"			: "必要なコマンドを実行できませんでした", 
	"ErrElevation"			: "保護モードから昇格できませんでした",
	"ErrGuestSupport"		: "ゲストユーザーのインストールはサポートされていません", 
	"ErrDiskSpace"			: "ディスク容量が不足しています", 
	"ErrDownload"			: "インストールパッケージをダウンロードできませんでした",
	"ErrMsiInstallationFailed": "MSIのインストールに失敗しました。",
	"ErrInProgress"			: "インストールは既に実行中です。",
	// Aspera Installer error_admin_rights
	"ErrAdminRights"		: "管理者権限が必要です。インストーラをダウンロードして実行する必要があります。",
	"Download"				: "今すぐダウンロードしてください。",
	// Codes for AW.ConnectInstaller.getEnvSupportInfo() messages
	"chromeBrowser" : "インストーラをダウンロードして実行してください。",
	"legacy10_4Safari4_0" 	: "Mac OS X 10.4でSafari 4が実行されているようです。",
	"10_5Safari4_0" 		: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Safariブラウザーの最新バージョンを今すぐ入手してください</a>。<p>または、以下のリンクからインストーラをダウンロードしてください。</p>",
	"10_5Safari5_0" 		: "Mac OS X 10.5でSafari 5が実行されているようです。",
	"10_6Safari5_0"			: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>Safariブラウザーの最新バージョンを今すぐ入手するか</a>、またはインストーラをダウンロードしてください。このプラグインは32ビットモードでのみ動作します。</p>",
	"firefox310_5Plus"		: "Aspera ConnectはFirefoxのこのバージョンでサポートされていません。<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Firefoxブラウザーの最新バージョンを今すぐ入手してください</a>。",
	"firefox3Win"			: "Aspera ConnectはFirefoxのこのバージョンでサポートされていません。<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Firefoxブラウザーの最新バージョンを今すぐ入手してください</a>。",
	"win64BitBrowser"		: "64ビットのブラウザーが使用されているようです。Aspera Connectは32ビットのブラウザーのみでサポートされます。",
	"lteIE6" 				: "Aspera Connectは Internet Explorerのこのバージョンでサポートされていません。アップグレードしてください。<br /><a onclick='window.open(this.href);return false;' href='http://microsoft.com/ie'>Internet Explorerの最新バージョンを今すぐ入手してください</a>。",
	"linux32"				: "Aspera Connectをダウンロードして、Linuxのインストーラスクリプトを実行してください。",
	"linux64"				: "Aspera Connectをダウンロードして、Linuxのインストーラスクリプトを実行してください。",
	"firefox3Linux" 		: "Aspera ConnectはFirefoxのこのバージョンでサポートされていません。<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>Firefoxブラウザーの最新バージョンを今すぐ入手してください</a>。",
	"unsupportedBrowser"	: "Aspera Connectはこのブラウザーでサポートされていません。",
	"unsupportedOS"			: "Aspera Connectはオペレーティングシステムでサポートされていません。",
	"unsupportedBrowserAndOS"	: "Aspera Connectはこのブラウザーとオペレーティングシステムでサポートされていません。",
	// Connect installer pages (auto and auto-iframe)
	"availableVersionLowerThanMinVersion" : "このWebサイトには、このプラットフォームではまだ利用できないAspera Connectのバージョンが必要です。",
	"downloadPackage"		: "Aspera Connectのダウンロード",
	"downloadInstaller"		: "インストーラをダウンロードしてください。",
	"downloadAndInstall"    : "Aspera Connectをダウンロードしてインストールしてください。",
	"javaFailed"            : "自動インストールを実行できません(Javaがありません)。ダウンロードしてインストールしてください。<a href='http://asperasoft.com/connect' target='_blank' class='link'>詳細を表示</a>。",
	"promptMessage"			: "Aspera Connectをこのサイトで使用して、ファイルを迅速かつ安全に転送します。",
	"installerTitle"		: "Aspera Connectインストーラ",
	"statusTitle"			: "Aspera Connectインストーラのステータス",
	"installNow"			: "Aspera Connectのインストール",
	"upgradeNow"			: "Aspera Connectのアップグレード",
	"cancel"				: "キャンセル",
	"quitBrowsers"			: "続行する前に、Aspera Connectを実行している他のブラウザーを終了してください。",
	"continue"				: "続行",
	"installing"			: "インストール中",
	"downloading"			: "ダウンロード中",
	"starting"				: "開始しています",
	"error"					: "エラー",
	"safariInstallerInstructions" : "Aspera Connectのインストールを開始するには、メッセージが表示されたら [許可] を選択します。",
	"firefoxInstallerInstructions"	: "Aspera Connectのインストールを開始するには、メッセージが表示されたら [許可] を選択します。",
	"ieInstallerInstructions"	: "Aspera Connectのインストールを開始するには、メッセージが表示されたら [インストール] を選択します。",
	"generalInstallerInstructions"	: "メッセージが表示されたら、[許可] または [続行] をクリックしてください。",
	"installComplete"		: "インストールが完了しました。",
	"restartBrowser"		: "Aspera Connectの使用を開始するには、ブラウザーを再起動してください。",
	"refreshBrowser"		: "Aspera Connectの使用を開始するには、ブラウザーウィンドウを更新してください。",
	"restartNow"			: "今すぐ再起動",
	"refreshNow"			: "今すぐ更新",
	"confirmInstallLeave"	: "インストーラが終了するまでお待ちください。",
	"popupOpen"				: "別のウィンドウが開いています。Aspera Connectのインストールを終了するには、このウィンドウに表示される指示に従ってください。",
	"pluginInstallInfo"		: "これで、Asperaインストーラプラグインが迅速にインストールされます。次に、Aspera Connectソフトウェアの自動インストールを行います。",
	"version"				: "バージョン",
	"installThankYou"		: "Aspera Connectの最新バージョンをご利用いただき、ありがとうございます。",
	"skipAutoInstall"		:"自動インストールプロセスをスキップするには、"
};

AW.localize["zh-CN"] = {
	// Aspera Installer error codes for Connect installation
	"ErrInstallerNotSigned"	: "安装程序未经 Aspera 签名", 
	"ErrExecution"			: "无法执行必要命令", 
	"ErrElevation"			: "无法提升脱离受保护模式",
	"ErrGuestSupport"		: "不支持来宾用户安装", 
	"ErrDiskSpace"			: "磁盘空间不足", 
	"ErrDownload"			: "无法下载安装程序包",
	"ErrMsiInstallationFailed": "MSI 安装失败。",
	"ErrInProgress"			: "安装已在进行中。",
	// Aspera Installer error_admin_rights
	"ErrAdminRights"		: "需要管理员权限。必须下载和运行安装程序。",
	"Download"				: "立即下载。",
	// Codes for AW.ConnectInstaller.getEnvSupportInfo() messages
	"chromeBrowser" : "请下载并运行安装程序。",
	"legacy10_4Safari4_0" 	: "看起来您在 Mac OS X 10.4 上运行 Safari 4。",
	"10_5Safari4_0" 		: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>立即获取最新版的 Safari 浏览器</a>。<p>否则，请从下面链接下载安装程序。</p>",
	"10_5Safari5_0" 		: "看起来您在 Mac OS X 10.5 上运行 Safari 5。",
	"10_6Safari5_0"			: "<a onclick='window.open(this.href);return false;' href='http://www.apple.com/safari/'>立即获取最新版的 Safari 浏览器</a>，或下载安装程序。插件将仅在 32 位模式中运行。</p>",
	"firefox310_5Plus"		: "但是，此版本的 Firefox 不支持 Aspera Connect。<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>立即获取最新版的 Firefox 浏览器</a>。",
	"firefox3Win"			: "但是，此版本的 Firefox 不支持 Aspera Connect。<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>立即获取最新版的 Firefox 浏览器</a>。",
	"win64BitBrowser"		: "看起来您在使用 64 位浏览器。只有 32 位浏览器才支持 Aspera Connect。",
	"lteIE6" 				: "但是，此版本的 Internet Explorer 不支持 Aspera Connect。请升级。<br /><a onclick='window.open(this.href);return false;' href='http://microsoft.com/ie'>立即获取最新版的 Internet Explorer</a>。",
	"linux32"				: "请下载 Aspera Connect 并运行 Linux 安装程序脚本。",
	"linux64"				: "请下载 Aspera Connect 并运行 Linux 安装程序脚本。",
	"firefox3Linux" 		: "但是，此版本的 Firefox 不支持 Aspera Connect。<br /><a onclick='window.open(this.href);return false;' href='http://mozilla.org/firefox'>立即获取最新版的 Firefox 浏览器</a>。",
	"unsupportedBrowser"	: "但是，此浏览器不支持 Aspera Connect。",
	"unsupportedOS"			: "但是，此操作系统不支持 Aspera Connect。",
	"unsupportedBrowserAndOS"	: "但是，此浏览器和操作系统不支持 Aspera Connect。",
	// Connect installer pages (auto and auto-iframe)
	"availableVersionLowerThanMinVersion" : "此平台尚未提供该网站需要的 Aspera Connect 版本。",
	"downloadPackage"		: "下载 Aspera Connect",
	"downloadInstaller"		: "下载安装程序",
	"downloadAndInstall"    : "请下载并安装 Aspera Connect。",
	"javaFailed"            : "无法执行自动安装（无 Java）。请下载并安装。<a href='http://asperasoft.com/connect' target='_blank' class='link'>了解更多 </a>。",
	"promptMessage"			: "本网站使用 Aspera Connect 来快速、安全地传输文件。",
	"installerTitle"		: "Aspera Connect 安装程序",
	"statusTitle"			: "Aspera Connect 安装程序状态",
	"installNow"			: "安装 Aspera Connect",
	"upgradeNow"			: "升级 Aspera Connect",
	"cancel"				: "取消",
	"quitBrowsers"			: "请退出运行 Aspera Connect 的其他浏览器，然后继续。",
	"continue"				: "继续",
	"installing"			: "正在安装",
	"downloading"			: "正在下载",
	"starting"				: "正在启动",
	"error"					: "错误",
	"safariInstallerInstructions" : "如果提示开始安装 Aspera Connect，则选择“允许”。",
	"firefoxInstallerInstructions"	: "如果提示开始安装 Aspera Connect，则选择“允许”。",
	"ieInstallerInstructions"	: "如果提示开始安装 Aspera Connect，则选择“安装”。",
	"generalInstallerInstructions"	: "如果出现提示，请单击“允许”或“继续”。",
	"installComplete"		: "安装完成。",
	"restartBrowser"		: "请重新启动浏览器窗口，以开始使用 Aspera Connect。",
	"refreshBrowser"		: "请刷新浏览器窗口，开始使用 Aspera Connect。",
	"restartNow"			: "立即重新启动",
	"refreshNow"			: "立即刷新",
	"confirmInstallLeave"	: "请等待安装程序完成安装。",
	"popupOpen"				: "另一个窗口已经打开。请遵循该窗口中的指示，完成完整 Aspera Connect。",
	"pluginInstallInfo"		: "这将快速安装 Aspera 安装程序插件。Aspera Connect 软件将自动安装下一个组件。",
	"version"				: "版本",
	"installThankYou"		: "感谢您运行最新的 Aspera Connect。",
	"skipAutoInstall"		:"若要跳过自动安装过程，请"
};

// Language defaults 
AW.localize["en"] = AW.localize["en-US"];
AW.localize["es"] = AW.localize["es-ES"];
AW.localize["fr"] = AW.localize["fr-FR"];
AW.localize["ja"] = AW.localize["ja-JP"];
AW.localize["zh"] = AW.localize["zh-CN"];
