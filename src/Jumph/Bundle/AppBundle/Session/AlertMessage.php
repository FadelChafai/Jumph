<?php

/**
 * This file is part of the Jumph package.
 *
 * (c) Peter Nijssen
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jumph\Bundle\AppBundle\Session;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AlertMessage
{

    /** @var SessionInterface */
    private $session;

    /**
     * Constructor.
     *
     * @param SessionInterface $session The session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Sets an alert message.
     *
     * @param string $message The message
     *
     * @return void
     */
    public function alert($message)
    {
        $this->session->getFlashBag()->add('alert', $message);
    }

    /**
     * Sets an error message.
     *
     * @param string $message The message
     *
     * @return void
     */
    public function error($message)
    {
        $this->session->getFlashBag()->add('error', $message);
    }

    /**
     * Sets an info message.
     *
     * @param string $message The message
     *
     * @return void
     */
    public function info($message)
    {
        $this->session->getFlashBag()->add('info', $message);
    }

    /**
     * Sets a success message.
     *
     * @param string $message The message
     *
     * @return void
     */
    public function success($message)
    {
        $this->session->getFlashBag()->add('success', $message);
    }

    /**
     * Resets the flash bag.
     *
     *  @return void
     */
    public function reset()
    {
        $this->session->getFlashBag()->clear();
    }
}
