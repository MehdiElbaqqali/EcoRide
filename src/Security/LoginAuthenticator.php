<?php

namespace App\Security;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private UrlGeneratorInterface $urlGenerator;
    private UtilisateurRepository $userRepository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        UtilisateurRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email'); 
        $password = $request->request->get('password');

        // 🛑 Debug: Vérification des données soumises
        dump("🔍 Tentative de connexion avec :", $email, $password);

        // Vérification si l'utilisateur existe en BDD
        $user = $this->userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            dump("❌ Utilisateur non trouvé !");
            die();
        } else {
            dump("✅ Utilisateur trouvé :", $user);
        }

        // Vérification du hasher
        dump("🛠 Hasher utilisé :", $this->passwordHasher);

        // Vérification du mot de passe
        dump("🔐 Hash stocké en BDD :", $user->getPassword());

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            dump("❌ Mot de passe incorrect !");
            die();
        } else {
            dump("✅ Mot de passe correct !");
        }

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($password),
            [new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token'))]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // 🛑 Debug: Connexion réussie
        dump("🚀 Connexion réussie !");
        die();

        return new RedirectResponse($this->urlGenerator->generate('home'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
