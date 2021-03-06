<?php


namespace App\Observer;


class Listener
{
    /**
     * @var callable $callable
     */
    private $callable;

    /**
     * @var int $priority
     */
    private $priority;

    /**
     * Define if callable must be executed only one time.
     * Default value is false.
     *
     * @var bool $once
     */
    private $once;

    /**
     * Count how many times callable has been executed.
     * (property is used as flag)
     *
     * @var int $calls
     */
    private $calls;

    /**
     * Define if all next listeners bind to this event will not be executed after current listener.
     * @var bool
     */
    private $propagation;

    /**
     * Listener constructor.
     * @param callable $callable
     * @param int $priority
     * @param bool $stopPropagation
     */
    public function __construct(callable $callable, int $priority, bool $stopPropagation)
    {
        $this->callable = $callable;
        $this->priority = $priority;
        $this->once = false;
        $this->calls = 0;
        $this->propagation = $stopPropagation;
    }

    /**
     * @param array $args
     * @return mixed|null
     */
    public function handle(array $args)
    {
        if ($this->once && $this->calls > 0) {
            return null;
        }
        $this->calls++;
        return call_user_func_array($this->callable, $args);
    }

    /**
     * Setup property once to true.
     * @return $this
     */
    public function once(): Listener
    {
        $this->once = true;
        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getCallable(): callable
    {
        return $this->callable;
    }

    public function getCalls(): int
    {
        return $this->calls;
    }


    public function getPropagation(): bool
    {
        return $this->propagation;
    }
}