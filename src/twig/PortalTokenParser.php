<?php

namespace carlcs\twigportal\twig;

use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

class PortalTokenParser extends AbstractTokenParser
{
    public function getTag(): string
    {
        return 'portal';
    }

    public function parse(Token $token): PortalNode
    {
        $nodes = [];
        $lineno = $token->getLine();
        $parser = $this->parser;
        $stream = $parser->getStream();

        $nodes['target'] =  $parser->getExpressionParser()->parseExpression();

        if ($stream->test(Token::NAME_TYPE, 'order')) {
            $stream->next();
            $nodes['order'] = $parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(Token::BLOCK_END_TYPE);
        $nodes['body'] = $this->parser->subparse([$this, 'decidePortalEnd'], true);
        $stream->expect(Token::BLOCK_END_TYPE);

        return new PortalNode($nodes, [], $lineno, $this->getTag());
    }

    public function decidePortalEnd(Token $token): bool
    {
        return $token->test('endportal');
    }
}
