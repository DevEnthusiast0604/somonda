@extends('layouts.frontend')
@section('content')


    <section class="terms_conditions">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms">
                        <h3>@lang('Purchase and Membership Terms and Conditions For Plusdeal.fr (CC EUROPE LTD.)') </h3>

                        <h4>@lang('Membership')</h4>
                        <p>
                            plusdeal.fr est un site d'adhésion en ligne qui offre des réductions importantes sur une variété
                            de produits bien connus.
                            Pour devenir membre, vous devez avoir plus de 18 ans,
                            ce que vous devez confirmer lors de votre inscription et de votre premier achat.
                            plusdeal.fr est réservé aux clients privés et à un usage personnel.
                            L'adhésion coûte 179 DKK par mois. Votre abonnement est débité chaque mois jusqu'à ce que vous
                            annuliez votre adhésion.
                            Vous pouvez résilier votre adhésion à tout moment en vous connectant à Plusdeal.fr et en
                            sélectionnant « Mon adhésion » dans l'onglet du menu.
                            La seule exception concerne les premières 48 heures d'adhésion, durant lesquelles votre
                            abonnement est verrouillé pour des raisons techniques et vous ne pouvez pas l'annuler
                            manuellement sous l'onglet « Mon adhésion ».
                            Sinon, vous pouvez annuler via le support à <a
                                href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>.
                        </p>


                        <h4>@lang('How to purchase')</h4>
                        <p>
                            Lorsque vous faites des achats sur Plusdeal.fr, vous devez devenir membre payant pour accéder à
                            notre large gamme de produits à prix réduits.
                            Vous pouvez vous inscrire pour un essai de 7 jours de notre adhésion et acheter immédiatement à
                            des prix réduits.
                            Après l'essai, votre adhésion sera automatiquement facturée 179 DKK chaque mois jusqu'à
                            annulation.
                            N'oubliez pas que vous pouvez vous désabonner de votre adhésion à tout moment.
                            Une fois votre commande terminée, vous recevrez une confirmation de commande par e-mail.
                            Vous recevrez un autre e-mail dès que nous aurons expédié votre commande.
                            Si vous souhaitez recevoir une copie physique de votre confirmation de commande, veuillez
                            envoyer un e-mail à
                            <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>.
                        </p>



                        <h4>@lang('Orders')</h4>
                        <p>
                            Sur plusdeal.fr, il est uniquement possible de commander des produits via notre site web.
                        </p>


                        <h4>@lang('Order cancellations')</h4>
                        <p>Si vous avez passé une commande et souhaitez l'annuler, veuillez contacter le support à notre
                            adresse e-mail
                            <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>
                        </p>


                        <h4>@lang('Payment')</h4>
                        <p>
                            Tous les paiements sont effectués via Stripe Payments en tant que passerelle de paiement.
                            Sur plusdeal.fr, vous pouvez payer avec VISA, VISA Debit, VISA Electron, MasterCard ou Maestro.
                            Tous les paiements et frais liés aux cartes sont intégrés dans le prix des produits et régulés
                            par CC EUROPE LTD.
                            Le paiement ne peut être effectué qu'avec une carte de crédit.
                            Aucun montant supérieur à celui approuvé lors de la finalisation de votre achat ne sera prélevé.
                        </p>
                        <p>
                            Tous les prix sont affichés toutes taxes comprises et correspondent aux prix du marché actuel.
                            Lorsque vous faites vos achats sur plusdeal.fr, tous les accords sont conclus en anglais.
                        </p>


                        <h4>@lang('Delivery')</h4>
                        <p>Les commandes passées sur plusdeal.fr sont livrées par DHL ou UPS.
                            Le délai de livraison estimé est de 3 à 5 jours ouvrables (après expédition).
                            Pour les membres de plusdeal.fr, la livraison est gratuite.</p>


                        <h4>@lang('Cancellation policies and return of products')</h4>
                        <p>plusdeal.fr offre une politique d'annulation de 90 jours (la politique standard légalement
                            approuvée est de 14 jours).
                            Cette période est valable à partir du jour où vous recevez la livraison de vos produits achetés.
                        </p>

                        <p>Si vous souhaitez retourner un ou plusieurs produits achetés, veuillez nous en informer par
                            e-mail à
                            <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a> (nous répondons sous 24 heures les
                            jours ouvrables).
                        </p>

                        <p>Vous ne pouvez pas annuler votre commande simplement en refusant d'accepter la livraison.
                            L'annulation doit être clairement communiquée en envoyant un e-mail à
                            <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>.
                        </p>

                        <p>Concernant les produits scellés qui ne peuvent être retournés pour des raisons de protection de
                            la santé ou d'hygiène,
                            votre droit d'annuler la commande prend fin dès que le sceau du produit est brisé après la
                            livraison.</p>


                        <h4>@lang('Returning products')</h4>
                        <p>Si vous souhaitez retourner votre commande, veuillez le faire sans retard excessif (au plus tard
                            7 jours après
                            nous avoir informés de votre décision de retourner votre achat). Vous devez couvrir tous les
                            frais liés au retour
                            des produits. Il est de votre responsabilité de vous assurer que les produits à retourner sont
                            emballés de manière sécurisée.</p>

                        <h4>Les conditions des produits retournés.</h4>

                        <p>Toute dépréciation de valeur liée à une utilisation inappropriée ou différente de l'usage prévu
                            du produit est à la
                            charge du client. Cependant, si vous endommagez le produit par mauvaise utilisation ou
                            négligence et demandez un
                            remboursement, vous pourriez ne recevoir qu'une partie, voire aucun remboursement du prix
                            d'achat, en fonction de
                            la valeur commerciale du produit concerné et de la nature de l'incident.</p>

                        <p>Dans le cas des produits, l'emballage d'origine peut jouer un rôle important dans la
                            détermination de leur valeur.
                            Nous vous encourageons donc à renvoyer les articles en bon état et sans dommage.</p>


                        <h4>@lang('Refund of purchase price')</h4>
                        <p>Si vous annulez votre achat, vous avez droit à un remboursement intégral de l'argent que vous
                            nous avez payé. En
                            cas de dépréciation liée à une utilisation inappropriée ou négligente du produit, le prix
                            d'achat est réduit.</p>
                        <p>Si vous exercez votre droit d'annulation, nous remboursons tous les paiements reçus, y compris
                            les frais de livraison
                            prépayés. Cependant, les frais supplémentaires résultant de votre propre choix de méthode de
                            livraison, qui diffèrent de
                            l'option de livraison standard la moins chère que nous proposons, ne sont pas remboursés. Le
                            paiement est effectué sans
                            retard injustifié et, en tout cas, au plus tard 14 jours après la réception de votre
                            notification d'annulation de votre
                            achat. Les remboursements sont effectués selon le même mode de paiement que celui utilisé pour
                            l'achat original.</p>
                        <p>Nous nous réservons le droit de retenir votre remboursement jusqu'à ce que nous ayons reçu les
                            produits à retourner,
                            sauf si vous pouvez fournir une documentation appropriée à cet égard.</p>
                        <p>Si vous souhaitez annuler votre achat, envoyez votre (vos) produit(s) à :</p>

                        <p><b>CC EUROPE LTD </b><br>
                            71-75 SHELTON STREET, COVENT GARDEN <br>
                            LONDON <br>
                            WC2H 9JQ <br>
                            Company number: 14009110
                        </p>

                        <h4>@lang('What do I need to return?')</h4>
                        <p>Pour accélérer le processus de retour, veuillez inclure une copie de votre confirmation de
                            commande en
                            plus des produits que vous retournez. Si vous n'avez plus votre confirmation de commande, vous
                            pouvez également
                            inclure l'adresse e-mail utilisée lors de la commande ou le numéro de commande lui-même.</p>


                        <h4>@lang('Your right to complain')</h4>
                        <p>CC EUROPE LTD. propose la procédure de réclamation légale standard, applicable pendant 12 mois
                            après la livraison.
                            Cela signifie que vous pouvez faire réparer, échanger votre produit, récupérer votre argent ou
                            recevoir une réduction de prix,
                            selon la situation.
                            Votre réclamation doit être valable, ce qui signifie que les défauts ne doivent pas être le
                            résultat d'une mauvaise utilisation
                            du produit ou d'un comportement destructeur.
                            Notez que pour les produits ayant une durée de vie limitée, votre droit de réclamation est
                            limité en conséquence.</p>


                        <h4>@lang('How quickly should I file a complaint?')</h4>
                        <p>Contactez-nous dès que vous remarquez une erreur ou des pièces manquantes sur un produit acheté
                            sur plusdeal.fr. Cela doit être fait dès que possible ou dans un délai raisonnable à partir du
                            moment où vous constatez qu'il y a un problème avec votre produit. Déposez votre réclamation via
                            <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>, après quoi nous traiterons le
                            problème en question.
                            Les réclamations sont considérées comme faites dans les délais si elles sont déposées dans les
                            deux mois suivant la détection des défauts du produit.
                        </p>


                        <h4>@lang('Defective product(s)')</h4>
                        <p>Dans le cas où un produit est défectueux ou manquant de pièces et que vous souhaitez déposer une
                            réclamation, envoyez l'article en question à :</p>
                        <p><b>CC EUROPE LTD</b> <br>
                            128 City Road <br>
                            LONDON <br>
                            United Kingdom <br>
                            EC1V 2NX <br>
                            Numéro d'organisation: 15652312
                        </p>
                        <p>Lorsque vous retournez un produit défectueux, vous devez indiquer le problème de manière aussi
                            détaillée que possible. Afin d'accélérer le processus, nous vous conseillons également d'inclure
                            des informations supplémentaires telles qu'un numéro de commande ou une adresse e-mail. Si votre
                            réclamation est valide, nous rembourserons vos frais de livraison, alors n'oubliez pas d'obtenir
                            un reçu.</p>
                        <p>Note : Nous n'acceptons pas les colis envoyés en contre-remboursement (COD).</p>


                        <h4>@lang('Complaints')</h4>
                        <p>Si vous n'êtes pas satisfait de votre adhésion ou de votre achat, n'hésitez pas à nous contacter
                            par e-mail à <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>.</p>

                        <h4>@lang('Children and minors')</h4>
                        <p>Lorsque vous vous inscrivez sur plusdeal.fr, vous devez confirmer que vous avez plus de 18 ans.
                            Si vous avez moins de 18 ans, l'inscription et l'abonnement doivent être effectués par un parent
                            ou un tuteur légal. Un accord peut être facilement révoqué par un parent ou un tuteur légal s'il
                            a été conclu par un mineur.</p>

                        <h4>@lang('Your personal information')</h4>
                        <p>Lorsque vous vous inscrivez sur plusdeal.fr, votre nom, adresse, numéro de téléphone et e-mail
                            sont stockés dans une base de données électronique des clients, accessible uniquement aux
                            employés de plusdeal. Ces informations personnelles sont enregistrées afin que nous puissions
                            livrer vos commandes et conformément à la législation comptable, qui stipule que les documents
                            liés aux transactions doivent être conservés pendant 5 ans après l'année comptable à laquelle
                            ils se rapportent. Avant que vos informations personnelles ne soient enregistrées sur
                            plusdeal.fr, nous nous assurons que vous donnez votre consentement et que vous savez exactement
                            quelles informations sont enregistrées. Les informations clients sont toujours cryptées.</p>
                        <p>En tant que client existant sur plusdeal.fr, vous avez toujours le droit de révoquer votre
                            inscription. Vous avez également le droit de savoir quelles informations personnelles nous avons
                            enregistrées à votre sujet. Ces droits font partie de la loi sur la protection des données. Pour
                            plus d'informations, contactez-nous à <a
                                href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>. CC EUROPE LTD. est responsable
                            des données stockées sur plusdeal.fr. Les informations fournies à plusdeal.fr ne sont pas
                            transmises ni vendues à des tiers. De plus, nous n'enregistrons aucune information sensible.
                            Lorsque vous vous inscrivez à notre newsletter, nous enregistrons votre adresse e-mail. Votre
                            e-mail est traité de manière confidentielle; nous ne le communiquons à personne. Vous pouvez
                            vous désabonner à tout moment via le lien dans le pied de page de la newsletter.</p>


                        <h4>@lang('Cookies')</h4>
                        <p>plusdeal.fr utilise des cookies. Nous le faisons dans le seul but de faciliter votre connexion et
                            de vous afficher des produits pertinents ainsi que de nouvelles offres lors de votre visite sur
                            plusdeal.fr. Un cookie est un fichier qui contient des données sur le fait que vous soyez un
                            client nouveau ou récurrent, les produits sur lesquels vous cliquez et d'autres informations sur
                            votre comportement sur le site web. Un cookie est stocké sur votre PC, tablette ou téléphone
                            mobile. Un cookie ne peut pas vous identifier en tant que personne. Il peut seulement
                            reconnaître votre PC, tablette ou téléphone mobile et garantir que vous visualisez une version
                            personnalisée de plusdeal.fr. Un cookie est généralement stocké pendant 12 mois.</p>
                        <p>Vous pouvez configurer les paramètres de votre navigateur pour recevoir un avertissement lorsque
                            vous recevez un cookie. Vous pouvez également supprimer complètement les cookies de votre
                            navigateur. Il est possible de supprimer vos cookies via les paramètres de votre navigateur, si
                            vous souhaitez le faire. Si vous avez des questions concernant vos cookies, n'hésitez pas à nous
                            contacter par e-mail à <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>.</p>


                        <h4>@lang('Disclaimer')</h4>
                        <p>Les prix sur plusdeal.fr sont des prix actuels, basés sur les prix du marché à un moment donné.
                            Par conséquent, nous nous réservons le droit de modifier les prix en cas de force majeure, y
                            compris les conflits de travail et les retards ou manquements de livraison de la part de nos
                            fournisseurs.</p>

                        <h4>@lang('Company information')</h4>
                        <p><b>CC EUROPE LTD</b> <br>
                            128 City Road <br>
                            LONDON <br>
                            United Kingdom <br>
                            EC1V 2NX <br>
                            Numéro d'organisation: 15652312
                        </p>
                        <p><strong>@lang('Year of Establishment'): 2023</strong></p>
                        <p>
                            <i>
                                Les présentes conditions sont régies et interprétées conformément aux lois du Royaume-Uni.
                                Tout différend ou toute différence de toute nature découlant de, ou en relation avec, ces
                                conditions sera soumis à la juridiction exclusive des tribunaux du Royaume-Uni.
                            </i>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection